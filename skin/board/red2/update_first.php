<?php
include_once "_common.php";

//$bo_table = $_POST['bo_table'];
//$page = $_POST['page'];

// 회원로그인이 아니면 되돌리기
if (!$member['mb_id']) {
    echo ("<script>alert('회원로그인후 이용하세요.'); history.back();</script>");
    exit;
}

$sql = "select mb_id from {$g5['write_prefix']}{$bo_table} where wr_id='{$wr_id}'";
$result = sql_query($sql); 
$data = sql_fetch_array($result);

if ($is_admin || $member['mb_id'] == $data['mb_id']) {
    
    $sql2 = "select wr_num from {$g5['write_prefix']}{$bo_table} order by wr_num asc";
    $result2 = sql_query($sql2); 
    $data2 = sql_fetch_array($result2);
    //echo "sql2 = ".$sql2 ."<br>";
    //echo "wr_num = ".$data2['wr_num'] ."<br>";
    
    $sql3 =" update {$g5['write_prefix']}{$bo_table} set wr_num = '{$data2['wr_num']}-1' where wr_id = '{$wr_id}'"; //선택된 게시글 순서변경
    sql_query($sql3);
    $sql4 = " update {$g5['write_prefix']}{$bo_table} set wr_num = '{$data2['wr_num']}-1' where wr_parent = '{$wr_id}'"; //선택된 게시글의 댓글 순서변경
    sql_query($sql4);
    //echo "sql3 = ".$sql3 ."<br>";
    //echo "sql4 = ".$sql4;
    //exit;
    
} else { // wr_id 가 글작성자 글인지 확인해서 아니면 되돌리기
    echo ("<script>alert('자신의 글만 수정이 가능합니다.'); history.back();</script>");
    exit;
}
?>
<script>
    location.href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>&page=<?php echo $page; ?>" ;
</script>