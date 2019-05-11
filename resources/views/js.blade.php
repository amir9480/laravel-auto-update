var laravelAutoUpdate = {
    updateText: null,
    download () {
        var self = this;
        self.updateText.html("@lang('laravel-auto-update::messages.downloading_update')" + "<b></b>");
        $.ajax({
            url: '/_laravel-auto-update/updater/download',
            success: function (response) {
                self.extract();
                $('.laravel-auto-update-notification').hide();
                window.location.reload();
            },
            error: function (xhr, response, errorThrown) {
                self.updateText.html("@lang('laravel-auto-update::messages.error_while_downlading_update')");
                self.updateText.css({color: 'red'});
                
            }
        });
    },
    extract () {
        var self = this;
        self.updateText.html("@lang('laravel-auto-update::messages.extracting_update')" + "<b></b>");
        $.ajax({
            url: '/_laravel-auto-update/updater/extract',
            success: function (response) {
                self.move();
            },
            error: function (xhr, response, errorThrown) {
                self.updateText.html("@lang('laravel-auto-update::messages.error_while_extracting_update')");
                self.updateText.css({color: 'red'});
            }
        });
    },
    move () {
        var self = this;
        self.updateText.html("@lang('laravel-auto-update::messages.moving_update')" + "<b></b>");
        $.ajax({
            url: '/_laravel-auto-update/updater/move',
            success: function (response) {
                self.updateText.html("@lang('laravel-auto-update::messages.updated_successfully')");
                self.updateText.css({color: 'green'});
                setTimeout(() => window.location.reload(), 3000);
            },
            error: function (xhr, response, errorThrown) {
                self.updateText.html("@lang('laravel-auto-update::messages.error_while_moving_update')");
                self.updateText.css({color: 'red'});
            }
        });
    }
};

document.addEventListener("DOMContentLoaded", function() {
    setTimeout(() => $.ajax({
        url: '/_laravel-auto-update/check',
        success: function (response) {
            if (response.available) {
                $("body").append(`@include('laravel-auto-update::html')`);

                $(`<style>@include('laravel-auto-update::styles')</style>`).appendTo("head");

                var layer = $(".laravel-auto-update-notification");
                var closeButton = $(".laravel-auto-update-notification .close-button");
                var updateButton = $(".laravel-auto-update-notification .update-button");
                laravelAutoUpdate.updateText = $(".laravel-auto-update-notification h1");

                var pointCounter = 1;
                setInterval(() => $(".laravel-auto-update-notification b").text(".".repeat(pointCounter = (pointCounter + 1 > 3) ? 1 : pointCounter + 1)), 750);

                layer.slideDown();
                closeButton.click(function () {
                    layer.slideUp();
                });

                updateButton.click(function () {
                    closeButton.hide();
                    updateButton.hide();
                    layer.addClass("fullscreen");
                    laravelAutoUpdate.download();
                });
            }
        }
    }), 500);
});

var x = 1;
setInterval(function() {
    x += 0.3;
    $('.laravel-auto-update-notification').css('background-position-x', x + 'px');
}, 1);