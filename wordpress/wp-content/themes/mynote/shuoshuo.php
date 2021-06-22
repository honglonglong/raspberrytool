<?php /*
    Template Name: shuoshuo
      */
    get_header(); ?>

<?php 
if (!empty($_POST)): 
    // Create post object
    $shuoshuo_title = "说说@".date('Y年n月j日G:i');
    $my_post = array(
        'post_title'    => wp_strip_all_tags( $shuoshuo_title ),
        'post_content'  => $_POST['shuoshuo_content'],
        'post_status'   => 'publish',
        'post_type'     => 'shuoshuo'
    );

    // Insert the post into the database
    wp_insert_post( $my_post, $resp );
    echo "<br/>已经发布:" . $resp;
?>

<?php endif; ?>

<style type="text/css">
    #shuoshuo_content {
        background-color: #fff;
        padding: 10px;
        min-height: 500px;
    }
    /* shuo */
    body.theme-dark .cbp_tmtimeline::before {
        background: RGBA(255, 255, 255, 0.06);
    }
    ul.cbp_tmtimeline {
        padding: 0;
    }
    div class.cdp_tmlabel > li .cbp_tmlabel {
        margin-bottom: 0;
    }
    .cbp_tmtimeline {
        margin: 30px 0 0 0;
        padding: 0;
        list-style: none;
        position: relative;
    }
    /* The line */
    .cbp_tmtimeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 4px;
        background: RGBA(0, 0, 0, 0.02);
        //left: 80px;
        //margin-left: 10px;
    }
    .cbp_tmtimeline > li {
       margin-left:10px;
    }
    /* The date/time */
    .cbp_tmtimeline > li .cbp_tmtime {
        display: block;
        /* width: 29%; */
        /* padding-right: 110px; */
        max-width: 70px;
        position: absolute;
    }
    .cbp_tmtimeline > li .cbp_tmtime span {
        display: block;
        text-align: right;
    }
    .cbp_tmtimeline > li .cbp_tmtime span:first-child {
        font-size: 0.9em;
        color: #bdd0db;
    }
    .cbp_tmtimeline > li .cbp_tmtime span:last-child {
        font-size: 1.2em;
        color: #9BCD9B;
    }
    .cbp_tmtimeline > li:nth-child(odd) .cbp_tmtime span:last-child {
        //color: RGBA(255, 125, 73, 0.75);
    }
    div.cbp_tmlabel > p {
        margin-bottom: 0;
    }
    /* Right content */
    .cbp_tmtimeline > li .cbp_tmlabel {
        margin: 0 0 45px 65px;
        background: #9BCD9B;
        color: #fff;
        padding: .8em 1.2em .4em 1.2em;
        /* font-size: 1.2em; */
        font-weight: 300;
        line-height: 1.4;
        position: relative;
        border-radius: 5px;
        transition: all 0.3s ease 0s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        display: block;
        width: 80%;
    }
    .cbp_tmlabel:hover {
        /* transform:scale(1.05); */
        transform: translateY(-3px);
        z-index: 1;
        -webkit-box-shadow: 0 15px 32px rgba(0, 0, 0, 0.15) !important
    }
    .cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel {
        //background: RGBA(255, 125, 73, 0.75);
    }
    /* The triangle */
    .cbp_tmtimeline > li .cbp_tmlabel:after {
        right: 100%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-right-color: #9BCD9B;
        border-width: 10px;
        top: 4px;
    }
    .cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel:after {
        //border-right-color: RGBA(255, 125, 73, 0.75);
    }
    p.shuoshuo_time {
        margin-top: 10px;
        border-top: 1px dashed #fff;
        padding-top: 5px;
    }

    /* Media */
    @media screen and (max-width: 65.375em) {
        .cbp_tmtimeline > li .cbp_tmtime span:last-child {
            font-size: 1.2em;
        }
    }
    .shuoshuo_author_img img {
        border: 1px solid #ddd;
        padding: 2px;
        float: left;
        border-radius: 64px;
        transition: all 1.0s;
    }
    .avatar {
        -webkit-border-radius: 100% !important;
        -moz-border-radius: 100% !important;
        box-shadow: inset 0 -1px 0 #3333sf;
        -webkit-box-shadow: inset 0 -1px 0 #3333sf;
        -webkit-transition: 0.4s;
        -webkit-transition: -webkit-transform 0.4s ease-out;
        transition: transform 0.4s ease-out;
        -moz-transition: -moz-transform 0.4s ease-out;
    }
    .zhuan {
        transform: rotateZ(720deg);
        -webkit-transform: rotateZ(720deg);
        -moz-transform: rotateZ(720deg);
    }
    .new_shuoshuo{
        padding-left: 1.2em;
    }
    .new_shuoshuo textarea{
        width:100%;
    }
    .fa-clock-o {
        width: 130px;
    }
    .cbp_tmheader {
        width: 40px;
    }
    /* end */
</style>
</head>
<body>
<div id="primary" class="content-area" style="">
    <main id="main" class="site-main" role="main">
        <div id="shuoshuo_content">
            <ul class="cbp_tmtimeline">
            <?php if(is_user_logged_in()): ?>
                <li><div class="new_shuoshuo">
                    <form action="/shuoshuo/" method="post" id="shuoshuo_form">
                        <div class="shuoshuo_content">
                        <textarea name="shuoshuo_content"></textarea>
                        </div>
                        <div class="shuoshuo_button">
                        <input type="submit" value="提交" id="btn_submit"/>
                        </div>
                    </form>
                </div>
                </li>
            <?php endif; ?>
                <?php query_posts("post_type=shuoshuo&post_status=publish&posts_per_page=-1");if (have_posts()) : 
                    $last_time = "";
                    while (have_posts()) : 
                        the_post(); ?>
                    <li>
                        <?php 
                        $current_post_date = get_the_time('Y-n-j');
                        #$time_display = get_the_time('Y年n月j日G:i');
                        if(strcmp($last_time, $current_post_date)==0): ?>
                            <p class="shuoshuo_time">
                            <i class="fa fa-clock-o">&nbsp;</i>
                            </p>
                        <?php  
                        else:?>
                        <p class="shuoshuo_time"><i class="fa fa-clock-o">
                        <?php the_time('Y年n月j日'); ?></i>
                        </p>
                        <?php  
                        endif;
                        $last_time =  $current_post_date;
                        ?>
                        <div class="cbp_tmheader">
                                <?php the_time('G:i'); ?>
                        </div>
                    <div class="cbp_tmlabel">
                        <p></p>
                       
								 <?php if(is_user_logged_in()): ?>
                        <p><?php the_content(); ?></p>
								 <?php  
                        else:?>
								 <p><?php the_title(); ?></p>
								 <?php endif; ?>
                        <p></p>
                    </div>
                    <?php endwhile;endif; ?>
                </li>
            </ul>
        </div>
    </main>
    <!-- .site-main -->
</div>
<script type="text/javascript">
    $(function () {
        var oldClass = "";
        var Obj = "";
        $(".cbp_tmtimeline li").hover(function () {
            Obj = $(this).children(".shuoshuo_author_img");
            Obj = Obj.children("img");
            oldClass = Obj.attr("class");
            var newClass = oldClass + " zhuan";
            Obj.attr("class", newClass);
        }, function () {
            Obj.attr("class", oldClass);
        });
    })
</script>
<?php get_footer();?>
