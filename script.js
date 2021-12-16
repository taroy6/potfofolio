$(function() {
  $('.hintbutton').on('click', function(){
    $(this).next().toggleClass('open');
  });
});

$(function() {
  $('.index-list').on('click', function () {
    $(this).next().slideToggle();
  });
  
});

/*
$(function() {
	$('.back-top').on('click', function() {
		confirm('Are you sure you want to exit?');
	});

});
*/

$(function() {
  //	フォームが送信されるときのイベント予約
  $('.back').click(function(){
    if(!confirm('本当に削除しますか？')){
        /* キャンセルの時の処理 */
        return false;
    }else{
        /*　OKの時の処理 */
        location.href = 'index.php';
    }
});
  });



$(function(){
  
  $('.clone-btn').on('click',function () {
    /*
    
    let clone1 =  $('.template1').clone();
    let clone2 = $('.template2').clone();
    let clone3 = $('.template3').clone();

    $('.clone-quiz-wrapper').append(clone1);
    $('.clone-quiz-wrapper').append(clone2);
    $('.clone-quiz-wrapper').append(clone3);


    $(function(){
  $("#test").on("click",function(){
    $(this).clone(true).appendTo("div");
  });
});

*/

  $('.template1').clone(true).appendTo(".clone-quiz-wrapper");
  $('.template2').clone(true).appendTo(".clone-quiz-wrapper");
 


  });
});