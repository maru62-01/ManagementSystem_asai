$(function () {
    $('#reserveModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);   // クリックしたボタン
        var part = button.data('part');        // data-part の値
        var modal = $(this);
        modal.find('#reservePartText').text(part + ' を削除しますか？');
        modal.find('#deleteDate').val(part);   // hidden input にセット
    });
});
