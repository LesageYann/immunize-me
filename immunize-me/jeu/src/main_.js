
enchant();


window.onload = function () {
    // size of the frame
    game = new Game(960, 540);
    //fps
    game.fps = 30;
    game.score = 0;
    game.touched = false;
    // images used in the game have to be preloaded here
    game.preload('graphic.png', '../chara/shippill.png', '../virus/vih.png', '../bg/blood.jpg', '../chara/pill.png');

    game.onload = function () {
        player = new Player(0, 152);
        enemies = new Array();

        game.rootScene.backgroundColor = 'black';

        game.rootScene.addEventListener('enterframe', function () {
            if(rand(1000) < game.frame / 20 * Math.sin(game.frame / 100) + game.frame / 20 + 50) {
                var y = rand(540);
                var omega = y < 160 ? 0.01 : -0.01;
                var enemy = new Enemy(960, y, omega);
                enemy.key = game.frame;
                enemies[game.frame] = enemy;
            }
            scoreLabel.score = game.score;
        });
        scoreLabel = new ScoreLabel(8, 8);
        game.rootScene.addChild(scoreLabel);
    };
    game.start();
};

var Player = enchant.Class.create(enchant.Sprite, {

    initialize: function (x, y) {
        enchant.Sprite.call(this, 292, 70);
        this.image = game.assets['chara/shippill.png'];
        this.scale(0.6);
        this.x = x;
        this.y = y;

        this.frame = 0;

        game.rootScene.addEventListener('touchstart', function (e) {
            player.y = e.y;
            game.touched = true;
        });
        game.rootScene.addEventListener('touchmove', function (e) {
            player.y = e.y;
        });
        game.rootScene.addEventListener('touchend', function (e) {
            player.y = e.y;
            game.touched = false;
        });


        this.addEventListener('enterframe', function () {
            if(game.touched && game.frame % 8 == 0) {
                var s = new PlayerShoot(this.x, this.y);
            }
        });


        game.rootScene.addChild(this);
    }
});


var Enemy = enchant.Class.create(enchant.Sprite, {

    initialize: function (x, y, omega) {

        enchant.Sprite.call(this, 150, 139);
        this.image = game.assets['virus/vih.png'];
        this.x = x;
        this.y = y;
        this.scale(0.6);

        this.frame = 3;

        this.omega = omega;

        this.direction = 0;
        this.moveSpeed = 7;

        this.addEventListener('enterframe', function () {
            this.move();
            if(this.y > 540 || this.x > 960 || this.x < -this.width || this.y < -this.height) {
                this.remove();
            } else if(this.age % 30 == 0) {
                var s = new EnemyShoot(this.x, this.y);
            }
        });

        game.rootScene.addChild(this);
    },

    move: function () {

        this.direction += this.omega;
        this.x -= this.moveSpeed * Math.cos(this.direction / 180 * Math.PI);
        this.y += this.moveSpeed * Math.sin(this.direction / 180 * Math.PI);
    },
    remove: function () {

        game.rootScene.removeChild(this);
        delete enemies[this.key];
    }
});




var ShootPlayer = enchant.Class.create(enchant.Sprite, {
    initialize: function (x, y, direction) {
        enchant.Sprite.call(this, 77, 28);
        this.scale(0.5);
        this.image = game.assets['chara/pill.png'];
        this.x = x;
        this.y = y;
        this.frame = 1;
        this.direction = direction;
        this.moveSpeed = 15;
        this.addEventListener('enterframe', function () {
            this.x += this.moveSpeed * Math.cos(this.direction);
            this.y += this.moveSpeed * Math.sin(this.direction);
            if(this.y > 540 || this.x > 960 || this.x < -this.width || this.y < -this.height) {
                this.remove();
            }
        });
        game.rootScene.addChild(this);
    },
    remove: function () {
        game.rootScene.removeChild(this);
        delete this;
    }
});

var ShootEnemy = enchant.Class.create(enchant.Sprite, {
    initialize: function (x, y, direction) {
        enchant.Sprite.call(this, 16, 14);
        this.image = game.assets['graphic.png'];
        this.x = x;
        this.y = y;
        this.frame = 1;
        this.direction = direction;
        this.moveSpeed = 15;
        this.addEventListener('enterframe', function () {
            this.x += this.moveSpeed * Math.cos(this.direction);
            this.y += this.moveSpeed * Math.sin(this.direction);
            if(this.y > 540 || this.x > 960 || this.x < -this.width || this.y < -this.height) {
                this.remove();
            }
        });
        game.rootScene.addChild(this);
    },
    remove: function () {
        game.rootScene.removeChild(this);
        delete this;
    }
});

var PlayerShoot = enchant.Class.create(ShootPlayer, {
    initialize: function (x, y) {
        ShootPlayer.call(this, x+152, y+22, 0);
        this.addEventListener('enterframe', function () {
            for (var i in enemies) {
                if(enemies[i].intersect(this)) {
                    this.remove();
                    enemies[i].remove();
                    game.score += 100;
                }
            }
        });
    }
});

var EnemyShoot = enchant.Class.create(ShootEnemy, {
    initialize: function (x, y) {
        ShootEnemy.call(this, x+27, y+62, Math.PI);
        this.addEventListener('enterframe', function () {
            if(player.within(this, 8)) {
                game.end(game.score, "SCORE: " + game.score)
            }
        });
    }
});
