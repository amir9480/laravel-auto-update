@keyframes scrollingba {
    from {
        background-position-x: 0px;
    }
    to {
        background-position-x: 399px;
    }
}

.laravel-auto-update-notification {
    position: fixed;
    width: 100%;
    height: 50px;
    top: 0;
    z-index: 10000000000000;
    box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.4);
    background-image: url('{{ $backgroundImage }}');
    background-repeat: repeat-x;
    direction: rtl !important;
    animation: scrollingba 5s infinite linear;
}

.laravel-auto-update-notification:before {
    content: '';
    position: absolute;
    width: 300%;
    height: 50px;
    top: 0;
    right: 0;
    background: linear-gradient(to left, rgb(255, 228, 228), transparent);

}

.laravel-auto-update-notification .up-loading {
    display: none;
    width: 10%;
}

.laravel-auto-update-notification.fullscreen {
    height: 100%;
    background-image: unset;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff;
}

.laravel-auto-update-notification.fullscreen:before {
    content: '';
    display: none;
}

.laravel-auto-update-notification.fullscreen .wrapper {
    display: none;
}

.laravel-auto-update-notification.fullscreen .up-loading {
    display: inline-block;
    width: 10%;
}

.laravel-auto-update-notification .wrapper {
    position: relative;
    width: 90%;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.laravel-auto-update-notification .wrapper .right-area {
    width: 70%;
    float: right;
}

.laravel-auto-update-notification .wrapper .left-area {
    width: 30%;
    float: left;
}

.laravel-auto-update-notification .up-button {
    background: #e17f7f;
    border: 0;
    padding: 4px 23px;
    margin-right: 15px;
    font-size: 14px;
    border: 2px solid #e17f7f;
    border-radius: 4px;
    color: #e17f7f;
    cursor: pointer;
    color: #fff;
    transition: all.2s;
    -webkit-transition: all.2s;
    -moz-transition: all.2s;
    -ms-transition: all.2s;
    -o-transition: all.2s;
}

.laravel-auto-update-notification .up-button:hover {
    background: #ca6969;
    border: 2px solid #ca6969;
}

.laravel-auto-update-notification .cl-button {
    position: absolute;
    top: 9px;
    left: 14px;
    width: 30px;
    height: 30px;
    background: #e17f7f;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    text-align: center;
    color: #fff;
    font-size: 20px;
    border: 0;
    cursor: pointer;
}

.laravel-auto-update-notification .cl-button:hover {
    background: #a75050;
}

.laravel-auto-update-notification .msg {
    color: #000;
    font-size: 20px;
}

.laravel-auto-update-notification.fullscreen h1 {
    display: inline;
}

@media (max-width: 600px) {
    .laravel-auto-update-notification .msg {
        font-size: 12px;
    }
    .laravel-auto-update-notification .up-button {
        padding: 4px 4px;
        margin-right: 3px;
        font-size: 11px;
    }
    .laravel-auto-update-notification .cl-button {
        position: absolute;
        top: 15px;
        left: 7px;
        width: 20px;
        height: 20px;
        font-size: 10px;
    }
    .laravel-auto-update-notification .up-loading {
        width: 40% !important;
    }
}
