<x-site-layout>
    <style>
        /* Remove default margin and padding */
        body,
        html {
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            /* background-color: #FF6FAC; */
        }

        /* Center the game container */
        #game-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/phaser@3/dist/phaser.min.js"></script>
    </head>

    <body>
        <div id="game-container">
        </div>
    </body>

    <script>
        let score = 0;
        let isMuted = false;
        let timer;
        let countdown; // Variable to store the countdown time
        let countdownText; // Variable to store the countdown text object

        // Main Menu Scene
        class MainMenuScene extends Phaser.Scene {
            constructor() {
                super({
                    key: "MainMenuScene"
                });
            }

            preload() {
                this.load.font("PoppinsExtraBold", "assets/fonts/Poppins-ExtraBold.ttf", "truetype");
                this.load.image("background", "assets/bg.png");
                this.load.image("start-button", "assets/start-button.png");
                this.load.image("masthead", "assets/masthead.png");
                this.load.image("samurai-pinko", "assets/samurai-pinko.png");
                this.load.image("mute", "assets/mute.png");
                this.load.image("unmute", "assets/unmute.png");
            }

            create() {
                this.add.image(config.width / 2, 400, "background").setDisplaySize(480, 800).setDepth(-1);
                this.add.image(config.width / 2, 0.75 * config.height, "start-button")
                    .setScale(0.4)
                    .setInteractive()
                    .on("pointerover", () => {
                        // Change cursor to pointer when hovering
                        this.input.setDefaultCursor('pointer');
                    })
                    .on("pointerout", () => {
                        // Revert cursor to default when not hovering
                        this.input.setDefaultCursor('default');
                    })
                    .on("pointerdown", () => {
                        this.scene.start("GamePlayScene");
                    });
                this.add.image(config.width / 2, 0.4 * config.height, "samurai-pinko").setScale(0.4);
                this.add.image(config.width / 2, 0.2 * config.height, "masthead").setScale(0.4);
            }
        }

        // Game Play Scene
        class GamePlayScene extends Phaser.Scene {
            constructor() {
                super({
                    key: "GamePlayScene"
                });
                this.swipeStart = null; // Store the starting position of the swipe
                this.trailPoints = []; // Store points for the trailing effect
                this.sliceGraphics = null; // Graphics object for the trailing effect
            }

            preload() {
                this.load.image("snack", "assets/snack.png");
                this.load.image("snack2", "assets/snack2.png");
                this.load.image("snack3", "assets/snack3.png");
                this.load.image("bomb", "assets/bomb.png");
                this.load.audio("slice", "assets/slice.mp3");
                this.load.audio("explosion", "assets/explosion.mp3");
                this.load.image("scoreboard", "assets/scoreboard.png");
                this.load.image("timer", "assets/timer.png");
            }

            create() {
                score = 0;
                countdown = 60;
                this.add.image(240, 400, "background").setDisplaySize(480, 800);

                this.add.image(80, 60, "scoreboard").setScale(0.55);
                this.add.image(440, 60, "timer").setScale(0.55);

                // Score text
                this.scoreText = this.add.text(95, 60, "0", {
                        fontFamily: "PoppinsExtraBold",
                        fontSize: "20px",
                        fill: "#fff"
                    })
                    .setOrigin(0.5);

                // Countdown text
                this.countdownText = this.add
                    .text(439, 64, countdown, {
                        fontFamily: "PoppinsExtraBold",
                        fontSize: "15px",
                        fill: "#000"
                    })
                    .setOrigin(0.5);

                // Timer for countdown
                this.time.addEvent({
                    delay: 1000, // Update every second
                    callback: this.updateCountdown,
                    callbackScope: this,
                    loop: true,
                });

                this.fruits = this.physics.add.group();
                this.bombs = this.physics.add.group();

                // Graphics object for the trailing effect
                this.sliceGraphics = this.add.graphics();

                // Touch input for swipe
                this.input.on("pointerdown", (pointer) => {
                    this.swipeStart = pointer.position.clone(); // Store the start position of the swipe
                    this.trailPoints = []; // Reset trail points
                });

                this.input.on("pointermove", (pointer) => {
                    if (this.swipeStart) {
                        this.updateTrail(pointer); // Update the trailing effect
                        this.checkSlice(pointer); // Check for slices
                    }
                });

                this.input.on("pointerup", () => {
                    this.swipeStart = null; // Reset swipe start
                    this.trailPoints = []; // Clear trail points
                    this.sliceGraphics.clear(); // Clear the trailing effect
                });

                this.spawnObjects();
            }

            updateTrail(pointer) {
                // Add the current pointer position to the trail points
                this.trailPoints.push({
                    x: pointer.x,
                    y: pointer.y
                });

                // Keep only the last 10 points for the trail
                if (this.trailPoints.length > 10) {
                    this.trailPoints.shift();
                }

                // Draw the trailing effect
                this.sliceGraphics.clear();
                if (this.trailPoints.length > 1) {
                    this.sliceGraphics.lineStyle(4, 0xff0000, 0.8); // Red trail
                    this.sliceGraphics.beginPath();
                    this.sliceGraphics.moveTo(this.trailPoints[0].x, this.trailPoints[0].y);
                    this.trailPoints.forEach((point) =>
                        this.sliceGraphics.lineTo(point.x, point.y)
                    );
                    this.sliceGraphics.strokePath();
                }
            }

            checkSlice(pointer) {
                // Check if any fruit is sliced
                this.fruits.getChildren().forEach((fruit) => {
                    if (
                        Phaser.Math.Distance.Between(pointer.x, pointer.y, fruit.x, fruit.y) <
                        50
                    ) {
                        this.createParticles(fruit.x, fruit.y, fruit.texture.key); // Create fruit particles
                        fruit.destroy();
                        score += 10;
                        this.scoreText.setText(score);
                        this.sound.play("slice");
                    }
                });

                // Check if any bomb is sliced
                this.bombs.getChildren().forEach((bomb) => {
                    if (
                        Phaser.Math.Distance.Between(pointer.x, pointer.y, bomb.x, bomb.y) < 50
                    ) {
                        this.createExplosion(bomb.x, bomb.y); // Create bomb explosion
                        bomb.destroy();
                        this.sound.play("explosion");
                        this.endGame();
                    }
                });
            }

            createParticles(x, y, texture) {
                // Create particles for sliced fruit
                const particles = this.add.particles(x, y, texture, {
                    speed: {
                        min: 200,
                        max: 400
                    },
                    angle: {
                        min: 0,
                        max: 360
                    },
                    scale: {
                        start: 0.6,
                        end: 0
                    },
                    lifespan: 500,
                    gravityY: 300,
                    quantity: 8,
                    emitting: false,
                });
                particles.explode();

                // Clean up particles after animation
                this.time.delayedCall(500, () => {
                    particles.destroy();
                });
            }

            createExplosion(x, y) {
                // Create explosion particles for sliced bomb
                const particles = this.add.particles(x, y, "flares", {
                    frame: ["red", "yellow", "orange"],
                    speed: {
                        min: 300,
                        max: 600
                    },
                    angle: {
                        min: 0,
                        max: 360
                    },
                    scale: {
                        start: 0.6,
                        end: 0
                    },
                    lifespan: 800,
                    gravityY: 300,
                    quantity: 20,
                    tint: [0xff0000, 0xff6600, 0xffff00],
                    emitting: false,
                });
                particles.explode();

                // Add a flash effect
                const flash = this.add.circle(x, y, 100, 0xffffff, 1);
                this.tweens.add({
                    targets: flash,
                    alpha: 0,
                    scale: 2,
                    duration: 200,
                    onComplete: () => flash.destroy(),
                });

                // Clean up particles after explosion
                this.time.delayedCall(800, () => {
                    particles.destroy();
                });
            }

            updateCountdown() {
                countdown--; // Decrement the countdown
                this.countdownText.setText(countdown); // Update the countdown text

                if (countdown <= 0) {
                    this.endGame(); // End the game when time runs out
                }
            }

            spawnObjects() {
                const fruits = ["snack", "snack2", "snack3"];
                const randomFruit = Phaser.Utils.Array.GetRandom(fruits);

                const x = Phaser.Math.Between(50, 430); // Random horizontal position
                const y = 900; // Spawn off-screen at the bottom (thrown higher)

                if (Math.random() > 0.2) {
                    const fruit = this.fruits.create(x, y, randomFruit);
                    fruit.setVelocity(Phaser.Math.Between(-100, 100), -
                    500); // Throw higher with more vertical velocity
                } else {
                    const bomb = this.bombs.create(x, y, "bomb");
                    bomb.setVelocity(Phaser.Math.Between(-100, 100), -
                    500); // Throw higher with more vertical velocity
                }

                this.time.delayedCall(1000, this.spawnObjects, [], this);
            }

            endGame() {
                this.scene.start("GameOverScene", {
                    score
                });
            }
        }

        // Game Over Scene
        class GameOverScene extends Phaser.Scene {
            constructor() {
                super({
                    key: "GameOverScene"
                });
            }

            create(data) {
                this.add.image(240, 400, "background").setDisplaySize(480, 800);

                this.add
                    .text(240, 300, "Game Over", {
                        fontSize: "48px",
                        fill: "#fff"
                    })
                    .setOrigin(0.5);
                this.add
                    .text(240, 400, data.score, {
                        fontSize: "32px",
                        fill: "#fff",
                    })
                    .setOrigin(0.5);

                const restartButton = this.add
                    .text(240, 500, "Restart", {
                        fontSize: "32px",
                        fill: "#fff"
                    })
                    .setOrigin(0.5)
                    .setInteractive()
                    .on("pointerdown", () => {
                        this.scene.start("GamePlayScene");
                    });
            }
        }

        const config = {
            type: Phaser.AUTO,
            width: 480, // Portrait width (mobile size)
            height: 800, // Portrait height (tablet size)
            backgroundColor: "#ffffff",
            parent: "game-container", // Bind the game to the container
            scene: [MainMenuScene, GamePlayScene, GameOverScene],
            physics: {
                default: "arcade",
                arcade: {
                    gravity: {
                        y: 200
                    }, // Gravity to make objects fall
                    debug: false,
                },
            },
            scale: {
                mode: Phaser.Scale.FIT,
                autoCenter: Phaser.Scale.CENTER_BOTH, // Center the game within the container
                min: {
                    width: 320, // Minimum width for mobile
                    height: 480,
                },
                max: {
                    width: 480, // Maximum width for tablet
                    height: 800,
                },
            },
        };

        const game = new Phaser.Game(config);
    </script>
</x-site-layout>
