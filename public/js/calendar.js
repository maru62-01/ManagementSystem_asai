$('.js-delete-btn').on('click', function () {
    $('.js-modal').fadeIn();

    // date属性から値を取得
    var reserveDate = $(this).data('date');
    var reservePart = $(this).data('part');

    // モーダルに値をセット（表示用）
    $('.modal-reserve-date').text(reserveDate);
    $('.modal-reserve-part').text("リモ" + reservePart + "部");

    // モーダル内 hidden input に値をセット（送信用
    $('.modal-input-date').val(reserveDate);
    $('.modal-input-part').val(reservePart);

    return false;
});

$('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
});

// / $(function () {

//     $('#reserveModal').on('show.bs.modal', function (event) {
//         var button = $(event.relatedTarget);   // クリックしたボタン
//         var part = button.data('part');        // data-part の値
//         var modal = $(this);
//         modal.find('#reservePartText').text(part + ' を削除しますか？');
//         modal.find('#deleteDate').val(part);   // hidden input にセット
//     });
// });
