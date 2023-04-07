<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

?>

    <!--footer-->

		<footer>

			<div id="footer">

				<div class="cd-tool visible-lg text-center">

					<a class="cd-top cd-is-visible cd-fade-out"><span class="fa fa-chevron-up"></span></a>

				</div>

				<div class="container">

					<div class="row">

						<div class="col-md-6 col-md-offset-3 footer-list text-center">



							<p> © <a href="<?php $this->options ->siteUrl(); ?>"><?php $this->options->title();?></a>. All Rights Reserved. | <a href="https://blog.moe2.works/admin" rel="nofollow">后台</a><br>
							Theme <a href="https://blog.moe2.works/archives/6/" rel="nofollow">MoeKratos</a> | <a href="https://icp.gov.moe/?keyword=20220914">萌ICP备20220914号</a></p>
                            <div id="runtime_span"></div>
						</div>

					</div>

				</div>

			</div>

		</footer>

	</div>

</div>



<script src="https://cdn.bootcdn.net/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type='text/javascript' src='<?php $this->options->themeUrl('js/jquery.waypoints.min.js'); ?>'></script>

<script type='text/javascript' src='<?php $this->options->themeUrl('js/jquery.stellar.min.js'); ?>'></script>

<script src="https://cdn.bootcdn.net/ajax/libs/jquery.hoverintent/1.8.1/jquery.hoverIntent.min.js"></script>

<script type='text/javascript' src='<?php $this->options->themeUrl('js/superfish.min.js'); ?>'></script>

<script type='text/javascript' src='<?php $this->options->themeUrl('js/kratos.js?ver=2.5.2'); ?>'></script>

<?php if (!$this->options->sidebarlr == 'single'): ?><script type="text/javascript">



if ($("#main").height() > $("#sidebar").height()) {

	var footerHeight = 0;

	if ($('#page-footer').length > 0) {

		footerHeight = $('#page-footer').outerHeight(true);

	}



	$('#sidebar').affix({

		offset: {

			top: $('#sidebar').offset().top - 30,

			bottom: $('#footer').outerHeight(true) + footerHeight + 6

		}

	});

}


<?php endif; ?>
</script>
<script type="text/javascript">
    var OriginTitle = document.title;
    var titleTime;
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            // $('[rel="icon"]').attr('href', "/funny.ico");
            document.title = '╭(°A°`)╮ 页面崩溃啦 ~';
            clearTimeout(titleTime);
        } else {
            $('[rel="icon"]').attr('href', "/favicon.ico");
            document.title = '(ฅ>ω<*ฅ) 噫又好啦 ~' + OriginTitle;
            titleTime = setTimeout(function() {
                document.title = OriginTitle;
            }, 2000);
        }
    });

    function show_runtime() {
        window.setTimeout("show_runtime()", 1000);
        X = new
        Date("06/27/2020 7:23:00");
        Y = new Date();
        T = (Y.getTime() - X.getTime());
        M = 24 * 60 * 60 * 1000;
        a = T / M;
        A = Math.floor(a);
        b = (a - A) * 24;
        B = Math.floor(b);
        c = (b - B) * 60;
        C = Math.floor((b - B) * 60);
        D = Math.floor((c - C) * 60);
        runtime_span.innerHTML = "已在二次元中度过了" + A + "天" + B + "小时" + C + "分" + D + "秒"
    }
    show_runtime();
</script>
<!-- require APlayer -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.css">
<script src="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.js"></script>
<!-- require MetingJS -->
<script src="https://cdn.jsdelivr.net/npm/meting@2/dist/Meting.min.js"></script>

<meting-js
	server="netease"
	type="playlist"
	id="551354847"
    fixed="True">
</meting-js>
</body>
</html>
