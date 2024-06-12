<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600&display=swap");

        :root {
            --primary-clr: rgba(228, 228, 229, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Nunito", sans-serif;
        }

        body {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100%;
            background: url(https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/8727c9b1-be21-4932-a221-4257b59a74dd);
            background-repeat: no-repeat;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            animation: slidein 120s forwards infinite alternate;
        }

        @keyframes slidein {
            0%,
            100% {
                background-position: 20% 0%;
                background-size: 3400px;
            }

            50% {
                background-position: 100% 0%;
                background-size: 2400px;
            }
        }

        .album-cover {
            width: 90%;
        }

        .swiper {
            width: 100%;
            padding: 40px 0 100px;
        }

        .swiper-slide {
            position: relative;
            max-width: 200px;
            aspect-ratio: 1/1;
            border-radius: 10px;
        }

        .swiper-slide img {
            object-fit: cover;
            width: 100%;
            height: 100%;
            border-radius: inherit;
            -webkit-box-reflect: below -5px linear-gradient(transparent, transparent, rgba(0, 0, 0, 0.4));
            transform-origin: center;
            transform: perspective(800px);
            transition: 0.3s ease-out;
            pointer-events: none;
            user-select: none;
        }

        .swiper-slide-active .overlay {
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            inset: 0;
            width: 100%;
            height: 98%;
            background-color: rgba(28, 22, 37, 0.6);
            border-radius: inherit;
            opacity: 0;
            transition: all 0.4s linear;
        }

        .swiper-slide:hover .overlay {
            opacity: 1;
        }

        .swiper-slide .overlay ion-icon {
            opacity: 0;
        }

        .swiper-slide-active:hover .overlay ion-icon {
            font-size: 4rem;
            color: #eb0b0b;
            opacity: 1;
            cursor: pointer;
        }

        /* Music Player */
        .music-player {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--primary-clr);
            width: 380px;
            padding: 10px 30px;
            border-radius: 20px;
        }

        .music-player h1 {
            font-size: 1.5rem;
            font-weight: 600;
            line-height: 1.6;
        }

        .music-player p {
            font-size: 1rem;
            font-weight: 400;
            opacity: 0.6;
        }

        /* Music Player Progress */
        #progress {
            appearance: none;
            -webkit-appearance: none;
            width: 100%;
            height: 7px;
            background: rgba(163, 162, 164, 0.4);
            border-radius: 4px;
            margin: 32px 0 24px;
            cursor: pointer;
        }

        #progress::-webkit-slider-thumb {
            appearance: none;
            -webkit-appearance: none;
            background: rgba(163, 162, 164, 0.9);
            width: 16px;
            aspect-ratio: 1/1;
            border-radius: 50%;
            outline: 4px solid var(--primary-clr);
            box-shadow: 0 6px 10px rgba(5, 36, 28, 0.3);
        }

        /* Music Player Controls */
        .controls {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .controls button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            aspect-ratio: 1/1;
            margin: 20px;
            background: rgba(163, 162, 164, 0.3);
            color: var(--primary-clr);
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.3);
            outline: 0;
            font-size: 1.1rem;
            box-shadow: 0 10px 20px rgba(5, 36, 28, 0.3);
            cursor: pointer;
            transition: all 0.3s linear;
        }

        .controls button:is(:hover, :focus-visible) {
            transform: scale(0.96);
        }

        .controls button:nth-child(2) {
            transform: scale(1.3);
        }

        .controls button:nth-child(2):is(:hover, :focus-visible) {
            transform: scale(1.25);
        }
    </style>
</head>

<body>
    <div class="album-cover">
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="./imagenghenhac/Picsart_22-05-09_17-33-57-727.jpg" />
                    <div class="overlay">
                        <a href="https://www.youtube.com/watch?v=aatr_2MstrI&ab_channel=CleanBandit" target="_blank"><ion-icon name="logo-youtube"></ion-icon></a>
                    </div>
                </div>
                <div class="swiper-slide">
                <img src="./imagenghenhac/IMG_1329.JPG" />
                    <div class="overlay">
                        <a href="https://www.youtube.com/watch?v=qEnfeG8uBRY&ab_channel=AliciaKeys-Topic" target="_blank"><ion-icon name="logo-youtube"></ion-icon></a>
                    </div>
                </div>
                <div class="swiper-slide">
                <img src="./imagenghenhac/IMG_1380.JPG" />
                    <div class="overlay">
                        <a href="https://www.youtube.com/watch?v=h5oHhGlWKf0&ab_channel=MuzikPlay" target="_blank"><ion-icon name="logo-youtube"></ion-icon></a>
                    </div>
                </div>
                <div class="swiper-slide">
                <img src="./imagenghenhac/IMG_1535.JPG" />
                    <div class="overlay">
                        <a href="https://www.youtube.com/watch?v=a5uQMwRMHcs&ab_channel=DaftPunkVEVO" target="_blank"><ion-icon name="logo-youtube"></ion-icon></a>
                    </div>
                </div>
                <div class="swiper-slide">
                <img src="./imagenghenhac/IMG_1643.JPG" />
                    <div class="overlay">
                        <a href="https://www.youtube.com/watch?v=H5v3kku4y6Q&ab_channel=HarryStylesVEVO" target="_blank"><ion-icon name="logo-youtube"></ion-icon></a>
                    </div>
                </div>
                <div class="swiper-slide">
                <img src="./imagenghenhac/IMG_1697.JPG" />
                    <div class="overlay">
                        <a href="https://www.youtube.com/watch?v=9HDEHj2yzew&ab_channel=DuaLipa" target="_blank"><ion-icon name="logo-youtube"></ion-icon></a>
                    </div>
                </div>
                <div class="swiper-slide">
                <img src="./imagenghenhac/IMG_1838.JPG" />
                    <div class="overlay">
                        <a href="https://www.youtube.com/watch?v=tCXGJQYZ9JA&ab_channel=TaylorSwiftVEVO" target="_blank"><ion-icon name="logo-youtube"></ion-icon></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="music-player">
        <h1>Title</h1>
        <p>Song Name</p>

        <audio id="song">
            <source src="song-list/Luke-Bergs-Gold.mp3" type="audio/mpeg" />
        </audio>

        <input type="range" value="0" id="progress" />

        <div class="controls">
            <button class="backward">
                <i class="fa-solid fa-backward"></i>
            </button>
            <button class="play-pause-btn">
                <i class="fa-solid fa-play" id="controlIcon"></i>
            </button>
            <button class="forward">
                <i class="fa-solid fa-forward"></i>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        const progress = document.getElementById("progress");
        const song = document.getElementById("song");
        const controlIcon = document.getElementById("controlIcon");
        const playPauseButton = document.querySelector(".play-pause-btn");
        const forwardButton = document.querySelector(".controls button.forward");
        const backwardButton = document.querySelector(".controls button.backward");
        const songName = document.querySelector(".music-player h1");
        const artistName = document.querySelector(".music-player p");

        const songs = [
            {
                title: "Symphony",
                name: "Clean Bandit ft. Zara Larsson",
                source:
                    "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/Clean-Bandit-Symphony.mp3",
            },
            {
                title: "Pawn It All",
                name: "Alicia Keys",
                source:
                    "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/Pawn-It-All.mp3",
            },
            {
                title: "Seni Dert Etmeler",
                name: "Madrigal",
                source:
                    "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/Madrigal-Seni-Dert-Etmeler.mp3",
            },
            {
                title: "Instant Crush",
                name: "Daft Punk ft. Julian Casablancas",
                source:
                    "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/Daft-Punk-Instant-Crush.mp3",
            },
            {
                title: "As It Was",
                name: "Harry Styles",
                source:
                    "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/Harry-Styles-As-It-Was.mp3",
            },

            {
                title: "Physical",
                name: "Dua Lipa",
                source:
                    "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/Dua-Lipa-Physical.mp3",
            },
            {
                title: "Delicate",
                name: "Taylor Swift",
                source:
                    "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/Taylor-Swift-Delicate.mp3",
            },
        ];

        let currentSongIndex = 3;

        function updateSongInfo() {
            songName.textContent = songs[currentSongIndex].title;
            artistName.textContent = songs[currentSongIndex].name;
            song.src = songs[currentSongIndex].source;
        }

        song.addEventListener("timeupdate", function () {
            if (!song.paused) {
                progress.value = song.currentTime;
            }
        });

        song.addEventListener("loadedmetadata", function () {
            progress.max = song.duration;
            progress.value = song.currentTime;
        });

        function pauseSong() {
            song.pause();
            controlIcon.classList.remove("fa-pause");
            controlIcon.classList.add("fa-play");
        }

        function playSong() {
            song.play();
            controlIcon.classList.add("fa-pause");
            controlIcon.classList.remove("fa-play");
        }

        function playPause() {
            if (song.paused) {
                playSong();
            } else {
                pauseSong();
            }
        }

        playPauseButton.addEventListener("click", playPause);

        progress.addEventListener("input", function () {
            song.currentTime = progress.value;
        });

        progress.addEventListener("change", function () {
            playSong();
        });

        forwardButton.addEventListener("click", function () {
            currentSongIndex = (currentSongIndex + 1) % songs.length;
            updateSongInfo();
            playPause();
        });

        backwardButton.addEventListener("click", function () {
            currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length;
            updateSongInfo();
            playPause();
        });

        updateSongInfo();

        var swiper = new Swiper(".swiper", {
            effect: "coverflow",
            centeredSlides: true,
            initialSlide: 3,
            slidesPerView: "auto",
            allowTouchMove: false,
            spaceBetween: 40,
            coverflowEffect: {
                rotate: 25,
                stretch: 0,
                depth: 50,
                modifier: 1,
                slideShadows: false,
            },
            navigation: {
                nextEl: ".forward",
                prevEl: ".backward",
            },
        });
    </script>
</body>

</html>