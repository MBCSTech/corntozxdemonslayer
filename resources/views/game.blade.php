<x-site-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/phaser@3/dist/phaser.min.js"></script>
    </head>
    <style>
        .navbars {
            position: sticky;
        }

        #game-container {
            position: relative;
            width: 100%;
            /* max-width: 480px; */
            overflow: hidden;
        }

        #game-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('assets/bg.png');
            background-size: cover;
            background-position: center;
            z-index: 0;
        }

        #phaser-game {
            position: relative;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        @media only screen and (min-width: 728px) {

            #game-container {
                height: calc(100vh - 64px);
            }

            #game-background {
                background: #FF6FAC;

            }

            #game-container canvas {
                background: url('assets/bg.png');
                background-position: center;
                background-size: cover;
            }

            #phaser-game canvas {
                border: 2px solid #000;
            }
        }

        @media only screen and (min-width: 1024px) {

            #game-container {
                max-width: 100%;

            }
        }
    </style>

    <body>
        <div id="game-container">
            <div id="game-background"></div>
            <div id="phaser-game"></div>
        </div>
    </body>

    <script>
        let score = 0;
        let isMuted = false;
        let timer;
        let countdown; // Variable to store the countdown time
        let countdownText; // Variable to store the countdown text object

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

                // Difficulty properties
                this.difficultyLevel = 1;
                this.lastDifficultyIncrease = 0;
                this.difficultyIncreaseInterval = 10;
                this.spawnDelay = 1000;
                this.minSpawnDelay = 300;
                this.baseObjectSpeed = 500;
                this.speedIncreasePerLevel = 50;
                this.bombProbability = 0.2;
                this.maxBombProbability = 0.35;

                this.maxObjectsOnScreen = 10; // Maximum number of objects allowed at once
                this.activeSpawnEvents = 0; // Track number of scheduled spawn events
                this.maxActiveSpawnEvents = 3; // Limit concurrent spawn events
            }

            preload() {
                this.load.font(
                    "PoppinsExtraBold",
                    "assets/fonts/Poppins-ExtraBold.ttf",
                    "truetype"
                );
                // this.load.image("background", "assets/bg.png");
                this.load.image("snack", "assets/snack.png");
                this.load.image("snack2", "assets/snack2.png");
                this.load.image("mute", "assets/mute.png");
                this.load.image("unmute", "assets/unmute.png");
                this.load.image("snack3", "assets/snack3.png");
                this.load.image("bomb", "assets/bomb2.png");
                this.load.audio("slice", "assets/slice.mp3");
                this.load.audio("explosion", "assets/explosion.mp3");
                this.load.audio("levelup", "assets/levelup.mp3"); // Add a level up sound
                this.load.image("scoreboard", "assets/scoreboard.png");
                this.load.image("timerc", "assets/timerc.png");
            }

            create() {
                // Add fade in effect when scene starts (reduced duration)
                this.cameras.main.fadeIn(250, 0, 0, 0); // Duration 250ms, black color

                this.isGameEnding = false;
                score = 0;
                countdown = 60;
                this.gameStartTime = this.time.now; // Record when the game started
                this.lastSpawnTime = this.time.now; // Track last spawn time

                // this.add.image(240, 400, "background").setDisplaySize(480, 800);

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

                this.muteButton = this.add
                    .image(0.9 * config.width, 0.2 * config.height, isMuted ? "mute" : "unmute")
                    .setScale(2)
                    .setInteractive({
                        useHandCursor: true
                    })
                    .on("pointerdown", this.toggleMute, this)
                    .setDepth(100);

                // Level indicator
                this.levelText = this.add
                    .text(240, 50, "LEVEL 1", {
                        fontFamily: "PoppinsExtraBold",
                        fontSize: "24px",
                        fill: "#FF6FAC",
                        stroke: "#000",
                        strokeThickness: 3
                    })
                    .setOrigin(0.5)
                    .setAlpha(0);

                // Timer for countdown
                this.countdownTimer = this.time.addEvent({
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

                // Start spawning objects
                this.startSpawning();
            }

            startSpawning() {
                // Initial object spawn
                this.spawnObjects();

                // Instead of a fixed timer, we'll handle spawning dynamically in the update method
            }

            toggleMute() {
                isMuted = !isMuted;

                // Update button texture based on mute state
                this.muteButton.setTexture(isMuted ? "mute" : "unmute");

                // Set global sound mute state
                this.sound.mute = isMuted;

                // Add a small feedback effect
                this.tweens.add({
                    targets: this.muteButton,
                    scale: 0.6,
                    duration: 100,
                    yoyo: true,
                    ease: 'Power1'
                });
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
                if (this.isGameEnding) return;

                countdown--; // Decrement the countdown
                this.countdownText.setText(countdown); // Update the countdown text

                // First check if the countdown has reached zero
                if (countdown <= 0) {
                    this.endGame('timeout'); // Specify 'timeout' as reason
                    return; // Stop processing - don't update difficulty if game is ending
                }

                // Check for difficulty increase every difficultyIncreaseInterval seconds
                // Only if the countdown is still positive
                const elapsedGameTime = Math.floor((this.time.now - this.gameStartTime) / 1000);
                if (elapsedGameTime >= this.lastDifficultyIncrease + this.difficultyIncreaseInterval) {
                    this.increaseDifficulty();
                }
            }

            increaseDifficulty() {
                this.difficultyLevel++;
                this.lastDifficultyIncrease = Math.floor((this.time.now - this.gameStartTime) / 1000);

                // Calculate new spawn delay (gets shorter as difficulty increases)
                this.spawnDelay = Math.max(
                    this.minSpawnDelay,
                    1000 - (this.difficultyLevel - 1) * 100
                );

                // Increase bomb probability (capped at maximum)
                this.bombProbability = Math.min(
                    this.maxBombProbability,
                    0.2 + (this.difficultyLevel - 1) * 0.03
                );

                // Show level up notification
                this.showLevelUpNotification();

                // Play level up sound
                if (this.sound.get('levelup')) {
                    this.sound.play("levelup", {
                        volume: 0.5
                    });
                }
            }

            showLevelUpNotification() {
                // Update level text
                this.levelText.setText("LEVEL " + this.difficultyLevel)
                    .setAlpha(0)
                    .setScale(0.5);

                // Animate level up notification
                this.tweens.add({
                    targets: this.levelText,
                    alpha: 1,
                    scale: 1.2,
                    duration: 500,
                    ease: 'Back.easeOut',
                    onComplete: () => {
                        this.tweens.add({
                            targets: this.levelText,
                            alpha: 0,
                            y: '+=20',
                            duration: 800,
                            delay: 800,
                            ease: 'Power2',
                            onComplete: () => {
                                this.levelText.y -=
                                    20; // Reset position for next notification
                            }
                        });
                    }
                });
            }

            spawnObjects() {
                // Check if we should spawn more objects based on limits
                const currentObjectCount = this.fruits.getChildren().length + this.bombs.getChildren().length;

                if (currentObjectCount >= this.maxObjectsOnScreen || this.isGameEnding) {
                    // If we've reached max objects, schedule another attempt later
                    this.time.delayedCall(500, () => {
                        if (!this.isGameEnding) {
                            this.activeSpawnEvents--;
                            this.spawnObjects();
                        }
                    });
                    return;
                }

                // Track active spawn event
                this.activeSpawnEvents++;

                const fruits = ["snack", "snack2", "snack3"];
                const randomFruit = Phaser.Utils.Array.GetRandom(fruits);

                const x = Phaser.Math.Between(50, 430);
                const y = 900;

                // Calculate current object speed based on difficulty
                const currentSpeed = this.baseObjectSpeed + (this.difficultyLevel - 1) * this.speedIncreasePerLevel;

                // Random horizontal velocity, getting more extreme at higher levels
                const horizontalSpeedRange = 50 + (this.difficultyLevel * 10);
                const horizontalSpeed = Phaser.Math.Between(-horizontalSpeedRange, horizontalSpeedRange);

                // Random bomb or fruit based on current probability
                if (Math.random() > this.bombProbability) {
                    const fruit = this.fruits.create(x, y, randomFruit);
                    fruit.setVelocity(horizontalSpeed, -currentSpeed);

                    // Add spin to fruits at higher difficulty
                    if (this.difficultyLevel > 2) {
                        fruit.setAngularVelocity(Phaser.Math.Between(-100, 100));
                    }
                } else {
                    const bomb = this.bombs.create(x, y, "bomb").setScale(0.7);
                    bomb.setVelocity(horizontalSpeed, -currentSpeed);

                    // Add spin to bombs at higher levels
                    if (this.difficultyLevel > 3) {
                        bomb.setAngularVelocity(Phaser.Math.Between(-150, 150));
                    }
                }

                // At higher levels, spawn additional objects occasionally
                // But only if we haven't reached our active event limit
                if (this.difficultyLevel >= 3 &&
                    Math.random() > 0.7 &&
                    currentObjectCount < this.maxObjectsOnScreen - 1 &&
                    this.activeSpawnEvents < this.maxActiveSpawnEvents) {

                    this.time.delayedCall(200, () => {
                        if (!this.isGameEnding) {
                            this.spawnObjects();
                        }
                    });
                }

                // Schedule next spawn based on current spawn delay
                this.time.delayedCall(this.spawnDelay, () => {
                    if (!this.isGameEnding) {
                        // Reduce active spawn count and attempt another spawn
                        this.activeSpawnEvents--;
                        this.spawnObjects();
                    } else {
                        // Game ending, reduce counter without spawning
                        this.activeSpawnEvents--;
                    }
                });
            }

            update() {
                // Clean up objects that have moved off screen to improve performance
                this.fruits.getChildren().forEach(fruit => {
                    if (fruit.y > 900 || fruit.y < -100 || fruit.x < -50 || fruit.x > 530) {
                        fruit.destroy();
                    }
                });

                this.bombs.getChildren().forEach(bomb => {
                    if (bomb.y > 900 || bomb.y < -100 || bomb.x < -50 || bomb.x > 530) {
                        bomb.destroy();
                    }
                });

                // Dynamically adjust max objects based on difficulty level
                // More objects allowed at higher levels, but with a reasonable cap
                this.maxObjectsOnScreen = 8 + Math.min(7, this.difficultyLevel);
            }

            endGame(reason = 'timeout') {
                // Only proceed if we haven't already triggered the end sequence
                if (this.isGameEnding) return;
                this.isGameEnding = true;

                if (this.countdownTimer) {
                    this.countdownTimer.remove(false);
                }

                // Pause physics to freeze objects in place
                this.physics.pause();

                // Create a semi-transparent black overlay
                const overlay = this.add.rectangle(240, 400, 480, 800, 0x000000, 0)
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

                // Add final score and level reached
                const statsText = this.add.text(240, 470, `Score: ${score}\nLevel: ${this.difficultyLevel}`, {
                        fontFamily: "PoppinsExtraBold",
                        fontSize: "30px",
                        fill: "#FFFFFF",
                        align: "center"
                    })
                    .setOrigin(0.5)
                    .setDepth(2001)
                    .setAlpha(0);

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
                                        // Show stats
                                        this.tweens.add({
                                            targets: statsText,
                                            alpha: 1,
                                            y: 480,
                                            duration: 300,
                                            ease: 'Power2',
                                            onComplete: () => {
                                                // Hold for a moment before transitioning
                                                this.time
                                                    .delayedCall(
                                                        1500,
                                                        () => {
                                                            // Fade out
                                                            this.cameras
                                                                .main
                                                                .fadeOut(
                                                                    250,
                                                                    0,
                                                                    0,
                                                                    0
                                                                );
                                                            this.cameras
                                                                .main
                                                                .once(
                                                                    Phaser
                                                                    .Cameras
                                                                    .Scene2D
                                                                    .Events
                                                                    .FADE_OUT_COMPLETE,
                                                                    () => {
                                                                        // Send the score to Laravel backend using fetch
                                                                        fetch
                                                                            ('/save-score', {
                                                                                method: 'POST',
                                                                                headers: {
                                                                                    'Content-Type': 'application/json',
                                                                                    'X-CSRF-TOKEN': document
                                                                                        .querySelector(
                                                                                            'meta[name="csrf-token"]'
                                                                                        )
                                                                                        .getAttribute(
                                                                                            'content'
                                                                                        )
                                                                                },
                                                                                body: JSON
                                                                                    .stringify({
                                                                                        score: score,
                                                                                        level: this
                                                                                            .difficultyLevel
                                                                                    })
                                                                            })
                                                                            .then(
                                                                                response => {
                                                                                    // Redirect to leaderboard page after storing in session
                                                                                    window
                                                                                        .location
                                                                                        .href =
                                                                                        "/leaderboard";
                                                                                }
                                                                            )
                                                                            .catch(
                                                                                error => {
                                                                                    console
                                                                                        .error(
                                                                                            'Error saving score:',
                                                                                            error
                                                                                        );
                                                                                    // Still redirect even if there was an error
                                                                                    window
                                                                                        .location
                                                                                        .href =
                                                                                        "/leaderboard";
                                                                                }
                                                                            );
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
                });
            }
        }

        const config = {
            type: Phaser.AUTO,
            width: 480, // Portrait width (mobile size)
            height: 750, // Portrait height (tablet size)
            backgroundColor: "transparent",
            transparent: true,
            parent: "phaser-game", // Bind the game to the container
            scene: [GamePlayScene],
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
