<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<style>
    #player-container #play-pause {
        position: fixed;
        text-indent: -999999px;
        height: 40px;
        width: 28px;
        padding: 12px 18px;
        z-index: 999999999999999;
        bottom: 110px;
        right: 32px;
        background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMiAyNHYtMjRsMjAgMTItMjAgMTJ6Ii8+PC9zdmc+);
        background-repeat: no-repeat !important;
        background-position: center;
        background-size: 16px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: 23px;
        background-color: #fcfcfc;
        border-radius: 50%;
        border: 1px solid #e3e3e3;
        box-shadow: 0 2px 10px 0 rgba(0,0,0,.15);
        cursor: pointer;
    }

    @media screen and (max-width: 413px) {
        #player-container #play-pause {
            height:20px;
            width: 10px;
            bottom: 85px;
            right: 30px;
        }
    }

    .play {
        background-position-x: 22.5px !important;
        background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMiAyNHYtMjRsMjAgMTItMjAgMTJ6Ii8+PC9zdmc+);
    }

    .pause {
        background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMTAgMjRoLTZ2LTI0aDZ2MjR6bTEwLTI0aC02djI0aDZ2LTI0eiIvPjwvc3ZnPg==) !important;
    }

    #player-container {
        display: none;
        align-items: center;
    }

</style>

<div hidden class="stopPlay">stop</div>
<div hidden class="startPlay">play</div>
<div hidden class="pausePlay">pause</div>

<script>

    if (document.location.href.indexOf('/shop') != -1) {
        const song_url = 'https://littleangel.ua/wp-content/uploads/TM-Little-Angel-YAngolyatko.mp3';
        const audio = new Audio(song_url);
        if (localStorage.getItem('audio_playtime') != null && localStorage.getItem('audio_playtime') != '') {
            audio.currentTime = localStorage.getItem('audio_playtime');
        }

        audio.addEventListener('timeupdate', (e, d) => {
                localStorage.setItem('audio_playtime', audio.currentTime);
                changeIconState();
            }
        );

        audio.loop = true;
        audio.autoplay = true;
        var stop = document.getElementsByClassName('stopPlay')[0];
        var pause = document.getElementsByClassName('pausePlay')[0];
        var start = document.getElementsByClassName('startPlay')[0];
        var it = 0;

        jQuery('body').append(`<div id="player-container"><div id="play-pause" class="play">Play</div></div>`);
        var controlBtn = document.getElementById('play-pause');

        function changeIconState() {
            jQuery('#player-container').css({"display": 'flex'})
            if (audio.paused) {
                controlBtn.className = "play";
            } else {
                controlBtn.className = "pause";
            }
        }

        function playPause() {
            if (audio.paused) {
                audio.play();
            } else {
                audio.pause();
                it = 1;
            }
        }

        document.addEventListener('click', () => {
            if (it == 0 && audio.paused) {
                audio.currentTime = localStorage.getItem('audio_playtime');
                audio.play();
                controlBtn.className = "pause";
                it++;
            } else {
                return false;
            }
        });
        if (!!stop) {
            stop.addEventListener('click', e => {
                if (e.target.className == 'stopPlay') {
                    audio.pause();
                    audio.currentTime = 0;
                    controlBtn.className = "play";
                }
            })
        }
        if (!!pause) {
            pause.addEventListener('click', e => {
                if (e.target.className == 'pausePlay') {
                    audio.pause();
                    controlBtn.className = "play";
                }
            })
        }
        if (!!start) {
            start.addEventListener('click', e => {
                if (e.target.className == 'startPlay') {
                    audio.play();
                    audio.currentTime = localStorage.getItem('audio_playtime');
                    controlBtn.className = "pause";
                }
            })
        }
        if (!!controlBtn) {
            controlBtn.addEventListener("click", playPause);
        }
    }
</script>

</body>
</html>
