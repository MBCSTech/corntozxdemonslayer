<x-site-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        // Main Menu Scene with double slashing effect
        class MainMenuScene extends Phaser.Scene {
            constructor() {
                super({
                    key: "MainMenuScene",
                });
            }

            preload() {
                this.load.font(
                    "PoppinsExtraBold",
                    "assets/fonts/Poppins-ExtraBold.ttf",
                    "truetype"
                );
                this.load.image("background", "assets/bg.png");
                this.load.image("start-button", "assets/start-button.png");
                this.load.image("masthead", "assets/masthead.png");
                this.load.image("samurai-pinko", "assets/samurai-pinko.png");
                this.load.image("instructions", "assets/instructions.png");
                this.load.image("mute", "assets/mute.png");
                this.load.image("unmute", "assets/unmute.png");

                // Add audio for slash effect
                this.load.audio("slash", "assets/slice.mp3");
            }

            create() {
                this.add
                    .image(config.width / 2, config.height / 2, "background")
                    .setDisplaySize(480, 800)
                    .setDepth(-1);

                const startButton = this.add
                    .image(config.width / 2, 0.75 * config.height, "start-button")
                    .setScale(0.4)
                    .setInteractive();

                this.tweens.add({
                    targets: startButton,
                    scale: 0.45,
                    duration: 800,
                    yoyo: true,
                    ease: "Sine.easeInOut",
                    repeat: -1,
                });

                // Initialize slash graphics with high depth to appear on top of everything
                this.slashGraphics = this.add.graphics().setDepth(1000);

                this.add
                    .image(config.width / 2, 0.4 * config.height, "samurai-pinko")
                    .setScale(0.4);
                this.add
                    .image(config.width / 2, 0.2 * config.height, "masthead")
                    .setScale(0.4);

                startButton
                    .on("pointerover", () => {
                        // Change cursor to pointer when hovering
                        this.input.setDefaultCursor("pointer");
                    })
                    .on("pointerout", () => {
                        // Revert cursor to default when not hovering
                        this.input.setDefaultCursor("default");
                    })
                    .on("pointerdown", () => {
                        // Disable button and reset cursor
                        startButton.disableInteractive();
                        this.input.setDefaultCursor("default");

                        // Create the first slashing effect (left to right)
                        this.createSlashEffect(1, () => {
                            // After first slash completes, create second slash (right to left)
                            this.createSlashEffect(-1, () => {
                                // After both slashes, shake camera and proceed
                                this.cameras.main.shake(200, 0.015);

                                // Add fade out effect after shake
                                this.cameras.main.once(
                                    Phaser.Cameras.Scene2D.Events.SHAKE_COMPLETE,
                                    (cam, effect) => {
                                        this.cameras.main.fadeOut(250, 0, 0, 0);

                                        // Start next scene after fade out completes
                                        this.cameras.main.once(
                                            Phaser.Cameras.Scene2D.Events
                                            .FADE_OUT_COMPLETE,
                                            (cam, effect) => {
                                                this.scene.start("GamePlayScene");
                                            }
                                        );
                                    }
                                );
                            });
                        });
                    });


                this.add
                    .image(config.width / 2, config.height - 5, "instructions")
                    .setScale(0.17)
                    .setOrigin(0.5, 1);
            }

            createSlashEffect(direction, onComplete) {
                // Play slash sound
                // this.sound.play("slash");

                // Clear any existing graphics
                this.slashGraphics.clear();

                // Define slash path coordinates
                const slashPoints = [];
                const startX = direction > 0 ? 0 : config.width;
                const endX = direction > 0 ? config.width : 0;

                // Create different Y positions for the two slashes
                const midY = direction > 0 ?
                    config.height * 0.4 : // First slash (left to right) higher
                    config.height * 0.6; // Second slash (right to left) lower

                const amplitude = 120; // Height of slash curve

                // Create curve for slash path
                for (let i = 0; i <= 20; i++) {
                    const t = i / 20;
                    const x = startX + (endX - startX) * t;
                    const y = midY + Math.sin(t * Math.PI) * amplitude;
                    slashPoints.push({
                        x,
                        y
                    });
                }

                // Animate the slash drawing
                let step = 0;
                const slashTimer = this.time.addEvent({
                    delay: 8, // Fast animation
                    callback: () => {
                        if (step < slashPoints.length - 1) {
                            // Draw each segment of the slash with varying thickness
                            const thickness = 15 * Math.sin((step / slashPoints.length) * Math.PI);

                            // Vibrant pink color
                            const pinkColor = 0xFF6FAC;

                            this.slashGraphics.lineStyle(thickness, pinkColor, 0.8);
                            this.slashGraphics.beginPath();
                            this.slashGraphics.moveTo(slashPoints[step].x, slashPoints[step].y);
                            this.slashGraphics.lineTo(slashPoints[step + 1].x, slashPoints[step + 1].y);
                            this.slashGraphics.strokePath();

                            // Add particles along the slash
                            if (step % 1 === 0) {
                                this.createSlashParticles(slashPoints[step].x, slashPoints[step].y,
                                    pinkColor);
                            }

                            step++;
                        } else {
                            slashTimer.destroy();

                            // Fade out the slash
                            this.tweens.add({
                                targets: this.slashGraphics,
                                alpha: 0,
                                duration: 150,
                                onComplete: () => {
                                    this.slashGraphics.clear();
                                    this.slashGraphics.alpha = 1;

                                    // Call the onComplete callback when the slash is done
                                    if (onComplete) {
                                        onComplete();
                                    }
                                }
                            });
                        }
                    },
                    callbackScope: this,
                    repeat: slashPoints.length
                });
            }

            createSlashParticles(x, y, color) {
                // Create spark-like particles at slash points
                const particles = this.add.particles(x, y, 'start-button', {
                    speed: {
                        min: 120,
                        max: 250
                    },
                    scale: {
                        start: 0.1,
                        end: 0
                    },
                    alpha: {
                        start: 0.7,
                        end: 0
                    },
                    lifespan: 250,
                    blendMode: 'ADD',
                    tint: color,
                    quantity: 3,
                    emitting: false
                }).setDepth(1001);

                particles.explode();

                // Clean up particles
                this.time.delayedCall(250, () => {
                    particles.destroy();
                });
            }
        }

        // Game Play Scene
        // Game Play Scene with enhanced slashing effect
        class GamePlayScene extends Phaser.Scene {
            constructor() {
                super({
                    key: "GamePlayScene",
                });
                this.swipeStart = null; // Store the starting position of the swipe
                this.trailPoints = []; // Store points for the trailing effect
                this.sliceGraphics = null; // Graphics object for the trailing effect
                this.slashActive = false; // Flag to control active slashing
            }

            preload() {
                this.load.image("snack", "assets/snack.png");
                this.load.image("snack2", "assets/snack2.png");
                this.load.image("snack3", "assets/snack3.png");
                this.load.image("bomb", "assets/bomb2.png");
                this.load.audio("slice", "assets/slice.mp3");
                this.load.audio("explosion", "assets/explosion.mp3");
                this.load.image("scoreboard", "assets/scoreboard.png");
                this.load.image("timerc", "assets/timerc.png");
            }

            create() {
                // Add fade in effect when scene starts (reduced duration)
                this.cameras.main.fadeIn(250, 0, 0, 0); // Duration 250ms, black color

                this.isGameEnding = false;
                score = 0;
                countdown = 60;
                this.add.image(240, 400, "background").setDisplaySize(480, 800);

                this.add.image(0.17 * config.width, 0.075 * config.height, "scoreboard").setScale(0.55);
                this.add.image(0.9 * config.width, 0.08 * config.height, "timerc").setScale(0.25);

                // Score text
                this.scoreText = this.add
                    .text(0.2 * config.width, 0.075 * config.height, "0", {
                        fontFamily: "PoppinsExtraBold",
                        fontSize: "20px",
                        fill: "#fff",
                    })
                    .setOrigin(0.5);

                // Countdown text
                this.countdownText = this.add
                    .text(0.86 * config.width, 0.086 * config.height, countdown, {
                        fontFamily: "PoppinsExtraBold",
                        fontSize: "18px",
                        fill: "#000",
                    })
                    .setOrigin(0.5)
                    .setAngle(-14);

                // Timer for countdown
                this.time.addEvent({
                    delay: 1000, // Update every second
                    callback: this.updateCountdown,
                    callbackScope: this,
                    loop: true,
                });

                this.fruits = this.physics.add.group();
                this.bombs = this.physics.add.group();

                // Graphics object for the trailing effect - set to high depth
                this.sliceGraphics = this.add.graphics({
                    lineStyle: {
                        width: 4,
                        color: 0xFF6FAC,
                        alpha: 0.8
                    }
                }).setDepth(1000);

                // Create a second graphics object for glow effect
                this.glowGraphics = this.add.graphics({
                    lineStyle: {
                        width: 12,
                        color: 0xFF6FAC,
                        alpha: 0.3
                    }
                }).setDepth(999);

                // Touch input for swipe
                this.input.on("pointerdown", (pointer) => {
                    this.swipeStart = pointer.position.clone(); // Store the start position of the swipe
                    this.trailPoints = []; // Reset trail points
                    this.slashActive = true; // Activate slashing

                    // Play slice sound when starting a slash
                    this.sound.play("slice", {
                        volume: 0.3
                    });
                });

                this.input.on("pointermove", (pointer) => {
                    if (this.swipeStart && this.slashActive) {
                        this.updateTrail(pointer); // Update the trailing effect
                        this.checkSlice(pointer); // Check for slices
                    }
                });

                this.input.on("pointerup", () => {
                    if (this.slashActive) {
                        this.slashActive = false;

                        // Create a fading effect for the trail
                        this.tweens.add({
                            targets: [this.sliceGraphics, this.glowGraphics],
                            alpha: 0,
                            duration: 150,
                            onComplete: () => {
                                this.sliceGraphics.clear().setAlpha(1);
                                this.glowGraphics.clear().setAlpha(1);
                                this.trailPoints = [];
                            }
                        });
                    }

                    this.swipeStart = null; // Reset swipe start
                });

                this.spawnObjects();
            }

            updateTrail(pointer) {
                // Add the current pointer position to the trail points
                this.trailPoints.push({
                    x: pointer.x,
                    y: pointer.y,
                    time: this.time.now // Store time for fade effect
                });

                // Keep only the last 15 points for the trail (increased from 10 for smoother effect)
                if (this.trailPoints.length > 15) {
                    this.trailPoints.shift();
                }

                // Draw the trailing effect
                this.drawTrail();
            }

            drawTrail() {
                if (this.trailPoints.length < 2) return;

                // Clear previous graphics
                this.sliceGraphics.clear();
                this.glowGraphics.clear();

                // Draw the glow effect (wider line, more transparent)
                this.glowGraphics.beginPath();
                this.glowGraphics.moveTo(this.trailPoints[0].x, this.trailPoints[0].y);

                for (let i = 1; i < this.trailPoints.length; i++) {
                    this.glowGraphics.lineTo(this.trailPoints[i].x, this.trailPoints[i].y);
                }
                this.glowGraphics.strokePath();

                // Draw the main slash (thinner line, more opaque)
                this.sliceGraphics.beginPath();
                this.sliceGraphics.moveTo(this.trailPoints[0].x, this.trailPoints[0].y);

                for (let i = 1; i < this.trailPoints.length; i++) {
                    // Calculate thickness based on position in the trail
                    const thickness = 8 * Math.sin((i / this.trailPoints.length) * Math.PI);
                    this.sliceGraphics.lineStyle(thickness, 0xFF6FAC, 0.8);
                    this.sliceGraphics.lineTo(this.trailPoints[i].x, this.trailPoints[i].y);

                    // Add particles along the trail for visual flair
                    if (i % 2 === 0 && this.trailPoints.length > 5) {
                        this.createSlashParticles(this.trailPoints[i].x, this.trailPoints[i].y);
                    }
                }
                this.sliceGraphics.strokePath();
            }

            createSlashParticles(x, y) {
                // Create spark-like particles for the slash
                const particles = this.add.particles(x, y, 'snack', {
                    speed: {
                        min: 50,
                        max: 150
                    },
                    scale: {
                        start: 0.05,
                        end: 0
                    },
                    alpha: {
                        start: 0.7,
                        end: 0
                    },
                    lifespan: 200,
                    blendMode: 'ADD',
                    tint: 0xFF6FAC, // Pink color
                    quantity: 1,
                    emitting: false
                }).setDepth(1001);

                particles.explode();

                // Clean up particles
                this.time.delayedCall(200, () => {
                    particles.destroy();
                });
            }

            checkSlice(pointer) {
                // Check if any fruit is sliced
                this.fruits.getChildren().forEach((fruit) => {
                    if (
                        Phaser.Math.Distance.Between(
                            pointer.x,
                            pointer.y,
                            fruit.x,
                            fruit.y
                        ) < 50
                    ) {
                        this.createFruitSliceEffect(fruit);
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
                        Phaser.Math.Distance.Between(
                            pointer.x,
                            pointer.y,
                            bomb.x,
                            bomb.y
                        ) < 50
                    ) {
                        this.createExplosion(bomb.x, bomb.y); // Create bomb explosion
                        bomb.destroy();
                        this.sound.play("explosion");

                        // Add camera shake on bomb hit
                        this.cameras.main.shake(200, 0.02); // Duration 200ms, Intensity 0.02

                        // End game after shake completes
                        this.cameras.main.once(
                            Phaser.Cameras.Scene2D.Events.SHAKE_COMPLETE,
                            (cam, effect) => {
                                this.endGame('bomb'); // Specify 'bomb' as reason
                            }
                        );
                    }
                });
            }

            createFruitSliceEffect(fruit) {
                // Create a small slash effect at the fruit position
                const slashGraphics = this.add.graphics().setDepth(1000);

                // Random angle for slash direction
                const angle = Phaser.Math.Between(0, 360);
                const length = 80;

                // Calculate endpoints for the slash
                const x1 = fruit.x + Math.cos(angle) * length / 2;
                const y1 = fruit.y + Math.sin(angle) * length / 2;
                const x2 = fruit.x - Math.cos(angle) * length / 2;
                const y2 = fruit.y - Math.sin(angle) * length / 2;

                // Draw slice line
                slashGraphics.lineStyle(8, 0xFF6FAC, 0.8);
                slashGraphics.beginPath();
                slashGraphics.moveTo(x1, y1);
                slashGraphics.lineTo(x2, y2);
                slashGraphics.strokePath();

                // Create fade out effect
                this.tweens.add({
                    targets: slashGraphics,
                    alpha: 0,
                    duration: 150,
                    onComplete: () => slashGraphics.destroy()
                });
            }

            createParticles(x, y, texture) {
                // Create particles for sliced fruit
                const particles = this.add.particles(x, y, texture, {
                    speed: {
                        min: 200,
                        max: 400,
                    },
                    angle: {
                        min: 0,
                        max: 360,
                    },
                    scale: {
                        start: 0.6,
                        end: 0,
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
                        max: 600,
                    },
                    angle: {
                        min: 0,
                        max: 360,
                    },
                    scale: {
                        start: 0.6,
                        end: 0,
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
                    this.endGame('timeout'); // Specify 'timeout' as reason (or use default)
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
                    const bomb = this.bombs.create(x, y, "bomb").setScale(0.7);
                    bomb.setVelocity(Phaser.Math.Between(-100, 100), -
                        500); // Throw higher with more vertical velocity
                }

                this.time.delayedCall(1000, this.spawnObjects, [], this);
            }

            endGame(reason = 'timeout') {
                // Only proceed if we haven't already triggered the end sequence
                if (this.isGameEnding) return;
                this.isGameEnding = true;

                // Pause physics to freeze objects in place
                this.physics.pause();

                // Create a semi-transparent black overlay
                const overlay = this.add.rectangle(240, 400, 480, 800, 0x000000, 0.7)
                    .setDepth(2000)
                    .setAlpha(0);

                // Set message based on end reason
                const message = reason === 'bomb' ? "ADUH! KENA BOM!" : "MASA TAMAT!";
                const textColor = reason === 'bomb' ? "#FF3030" : "#FF6FAC"; // Red for bomb, pink for timeout

                // Create the end text
                const endText = this.add.text(240, 400, message, {
                        fontFamily: "PoppinsExtraBold",
                        fontSize: reason === 'bomb' ? "42px" : "48px", // Slightly smaller for longer bomb text
                        fill: textColor,
                        stroke: "#FFFFFF", // White stroke for better visibility
                        strokeThickness: 6
                    })
                    .setOrigin(0.5)
                    .setDepth(2001)
                    .setAlpha(0)
                    .setScale(0.5);

                // Create animation sequence
                this.tweens.add({
                    targets: overlay,
                    alpha: 1,
                    duration: 300,
                    ease: 'Power2',
                    onComplete: () => {
                        // Animate the text appearance
                        this.tweens.add({
                            targets: endText,
                            alpha: 1,
                            scale: 1.2,
                            duration: 400,
                            ease: 'Back.easeOut',
                            onComplete: () => {
                                // Add a slight bounce effect
                                this.tweens.add({
                                    targets: endText,
                                    scale: 1,
                                    duration: 200,
                                    ease: 'Bounce.easeOut',
                                    onComplete: () => {
                                        // Hold for a moment before transitioning
                                        this.time.delayedCall(1000, () => {
                                            // Fade out
                                            this.cameras.main.fadeOut(
                                                250, 0, 0, 0);
                                            this.cameras.main.once(
                                                Phaser.Cameras
                                                .Scene2D.Events
                                                .FADE_OUT_COMPLETE,
                                                () => {
                                                    this.scene
                                                        .start(
                                                            "GameOverScene", {
                                                                score
                                                            });
                                                }
                                            );
                                        });
                                    }
                                });
                            }
                        });
                    }
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
            preload() {
                this.load.image("endscoreboard", "assets/endscoreboard.png");
                this.load.image("leaderboard", "assets/leaderboard.png");
                this.load.image("restart-button", "assets/restart-button.png");
                this.load.image("proceed-button", "assets/proceed-button.png");
            }

            create(data) {
                this.add.image(240, 400, "background").setDisplaySize(480, 800);

                // Add pink overlay with 30% opacity
                const overlay = this.add.rectangle(240, 400, 480, 800, 0xFF69B4, 0.4);

                this.add.image(config.width / 2, 0.12 * config.height, "masthead").setScale(0.45);
                this.add.image(config.width / 2, 0.35 * config.height, "endscoreboard").setScale(0.25);

                this.add.image(config.width / 2, 0.58 * config.height, "leaderboard").setScale(0.25);

                this.add
                    .text(0.58 * config.width, 0.36 * config.height, data.score, {
                        fontFamily: "PoppinsExtraBold",
                        fontSize: "32px",
                        fill: "#fff",
                    })
                    .setOrigin(0.5);

                const restartButton = this.add
                    .image(config.width / 2, 0.82 * config.height, "restart-button")
                    .setScale(0.2)
                    .setInteractive();

                const proceedButton = this.add
                    .image(config.width / 2, 0.9 * config.height, "proceed-button")
                    .setScale(0.2)
                    .setInteractive();


                restartButton.on("pointerdown", () => {
                        this.scene.start("GamePlayScene");
                    }).on("pointerover", () => {
                        // Change cursor to pointer when hovering
                        this.input.setDefaultCursor("pointer");
                    })
                    .on("pointerout", () => {
                        // Revert cursor to default when not hovering
                        this.input.setDefaultCursor("default");
                    })
                    .on("pointerdown", () => {
                        // Disable button and reset cursor
                        restartButton.disableInteractive();
                        this.input.setDefaultCursor("default");
                    });

                proceedButton.on("pointerdown", () => {
                        fetch('/save-score', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                score: data.score
                            })
                        }).then(() => {
                            window.location.href = '/leaderboard';
                        }).catch(error => {
                            console.error(error);
                        });
                    }).on("pointerover", () => {
                        // Change cursor to pointer when hovering
                        this.input.setDefaultCursor("pointer");
                    })
                    .on("pointerout", () => {
                        // Revert cursor to default when not hovering
                        this.input.setDefaultCursor("default");
                    })
                    .on("pointerdown", () => {
                        // Disable button and reset cursor
                        restartButton.disableInteractive();
                        this.input.setDefaultCursor("default");
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
