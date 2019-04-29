@keyframes rainbow-bg{
    100%,0%{
        background-color: rgb(255,0,0);
    }
    8%{
        background-color: rgb(255,127,0);
    }
    16%{
        background-color: rgb(255,255,0);
    }
    25%{
        background-color: rgb(127,255,0);
    }
    33%{
        background-color: rgb(0,255,0);
    }
    41%{
        background-color: rgb(0,255,127);
    }
    50%{
        background-color: rgb(0,255,255);
    }
    58%{
        background-color: rgb(0,127,255);
    }
    66%{
        background-color: rgb(0,0,255);
    }
    75%{
        background-color: rgb(127,0,255);
    }
    83%{
        background-color: rgb(255,0,255);
    }
    91%{
        background-color: rgb(255,0,127);
    }
}

.laravel-auto-update-notification {
    animation: rainbow-bg 10.0s linear;
    animation-iteration-count: infinite;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 4294967290;
    border-radius: 0px 0px 5px 5px;
    padding: 10px;
    box-shadow: 0px 0px 30px black;
    display: flex;
    align-items: center;
    justify-content: center;
}
.laravel-auto-update-notification.fullscreen {
    width: 100%;
    height: 100%;
    margin-left: unset;
    margin-right: unset;
    border-radius: unset;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0.8;
    animation: unset;
    background-color: black;
}

.laravel-auto-update-notification h1 {
    color: white;
    margin: unset;
    padding-left: 10px;
    padding-right: 10px;
}

.laravel-auto-update-notification > .display-inline {
    display: inline-block;
}

.laravel-auto-update-notification button {
    background: unset;
    border: 2px solid white;
    color: white;
    font-size: 20px;
    border-radius: 5px;
}
