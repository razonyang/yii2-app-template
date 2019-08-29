$(document).ready(function() {
    var likeLock = false;
    var likesCount = $('#likes-count');
    var btnLike = $('#btn-like');
    var btnDislike = $('#btn-dislike');

    function updateLikesCounter(count) {
        likesCount.text(parseInt(likesCount.text()) + count);
    }

    function acuquireLikeLock() {
        if (likeLock) {
            return false;
        }

        likeLock = true;
        return true;
    }

    function releaseLikeLock() {
        likeLock = false;
    }

    btnLike.click(function() {
        var id = $(this).attr('data-id');
        $.ajax('/api/frontend/v1/articles/' + id + '/likes', {
            method: 'PUT',
            dataType: 'json',
            beforeSend: function() {
                if (!acuquireLikeLock()) {
                    return false;
                }
            },
            success: function(response) {
                updateLikesCounter(1);
                btnDislike.show();
                btnLike.hide();
            },
            complete: function() {
                releaseLikeLock();
            }
        });
    });

    btnDislike.click(function() {
        var id = $(this).attr('data-id');
        $.ajax('/api/frontend/v1/articles/' + id + '/likes', {
            method: 'DELETE',
            dataType: 'json',
            beforeSend: function() {
                if (!acuquireLikeLock()) {
                    return false;
                }
            },
            success: function(response) {
                updateLikesCounter(-1);
                btnLike.show();
                btnDislike.hide();
            },
            complete: function() {
                releaseLikeLock();
            }
        });
    });
});