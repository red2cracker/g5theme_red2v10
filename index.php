<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<h2 class="sound_only">최신글</h2>

<div class="latest_wr">
<!-- 최신글 시작 { -->

    <?php
    //  최신글
    $sql = " select bo_table
                from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
                where a.bo_device <> 'mobile' ";
    if(!$is_admin)
        $sql .= " and a.bo_use_cert = '' ";
    $sql .= " and a.bo_table not in ('notice', 'gallery') ";     //공지사항과 갤러리 게시판은 제외
    $sql .= " order by b.gr_order, a.bo_order ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        if ($i%2==1) $lt_style = "margin-left:2%";
        else $lt_style = "";
    ?>
    <div style="float:left;<?php echo $lt_style ?>" class="lt_wr">
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/basic', $row['bo_table'], 6, 24);
        ?>
    </div>
    <?php
    }
    ?>
    <!-- } 최신글 끝 -->

</div>

<div class="latest_wr">
    <!--  사진 최신글2 { -->
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    echo latest('theme/pic_basic', 'gallery', 5, 23);
    ?>
    <!-- } 사진 최신글2 끝 -->
</div>

<!-- SNS 링크(목록대신 문단과 | 사용) -->
<!-- https://www.youtube.com/yt/about/brand-resources/#logos-icons-colors -->
<ul class="sns-link">
  <li class="sns_logo_twitter"><a href="https://twitter.com/red2cracker" title="트위터">트위터</a></li>
  <!-- <li class="sns_logo_facebook"><a href="https://www.facebook.com/red2network/">페이스북</a></li> -->
  <li class="sns_logo_blog"><a href="http://blog.naver.com/scabbard2" title="블로그">블로그</a></li>
  <li class="sns_logo_youtube"><a href="http://www.youtube.com/red2cracker" title="유튜브">유튜브</a></li>
  <li class="sns_logo_discord"><a href="https://discord.gg/F5ZcCwC" title="디스코드">디스코드</a></li>
  <li class="sns_logo_moddb"><a href="http://www.moddb.com/mods/korean-war-2" title="모드DB">모드DB</a></li>
</ul>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>