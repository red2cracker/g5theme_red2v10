<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<?php if ($is_admin == 'super') {  ?><!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> --><?php }  ?>

<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->

<script>

$(document).ready(function() {


function tbody_tr_href(a) {

//eq(0-14)
$("#bo_list tbody tr").eq(a).click(function() {
    var href = $("#bo_list .td_subject .bo_tit a").eq(a).attr("href");
    $(location).attr('href',href);
	
    //alert(href);
});

}


var tbody_tr_count = $("#bo_list tbody tr").length -1; //15 - 1 = 14

function add_href() {

for(a = 0; a <= tbody_tr_count; a++){
  tbody_tr_href(a);
  //alert(a);
}

}

//add_href();


var width_size = window.outerWidth;

$(window).resize(function (){
  if (width_size <= 767) {
    add_href();
  }
});

$(window).load(function (){
  if (width_size <= 767) {
    add_href();
  }
});


});

</script>

</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>