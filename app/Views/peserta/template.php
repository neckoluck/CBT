<!DOCTYPE html>
<html lang="en">

<head>
<style>
	*, body {
    	font-family: "Poppins", sans-serif;
    }
</style>
    <?= view('peserta/layout/head'); ?>
</head>

<?php if ($page != 'selesai' && $page != 'live-skor') : ?>

    <body class="bg-white">

        <!-- Main navbar -->
        <?= view('peserta/layout/main-navbar'); ?>

        <!-- /main navbar -->

        <!-- Page header -->
        <?= view('peserta/layout/page-header'); ?>
        <!-- /page header -->


        <!-- Page content -->
        <div class="page-content pt-0">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">
                    <?= view($content); ?>

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->


        <!-- Footer -->
        <?= view('peserta/layout/footer'); ?>
        <?= view('peserta/layout/modal'); ?>
        <!-- /footer -->

    </body>
    <?= view('peserta/layout/foot'); ?>

<?php else : ?>

    <body>
		<div class="page-content">
			<div class="content-wrapper">
				<div class="content d-flex justify-content-center align-items-center">
					<?= view($content); ?>
				</div>
			</div>
		</div>
	</body>
	<?php if ($page == 'live-skor') : ?>

    	<script type="text/javascript">
    
    		const actions = (action, option = undefined) => fetch(action, option)
    			.then(response => {
       	 			if (!response.ok) throw new Error(response.statusText);
        			return response.json();
    			})
    			.then(response => {
        			if (!response.status) throw response;
        			return response;
    			});

    		 async function loadscore() {
    			try {
                	const table1   = document.querySelector('#table-score');
                    const table2   = document.querySelector('#table-head-1');
                	const tb = document.querySelector('.table-scroll-1');
                	const response = await actions(table1.dataset.route, {
                    	method: 'GET',
                    	headers: {
                			'Content-Type': 'application/json',
                			'Accept': 'application/json'
            			}
                    });
                
                	table2.querySelector('tr').innerHTML    = response.head; 
                	table1.querySelector('tbody').innerHTML = response.body;
                
                } catch (error) {
                	console.log(error);
                }
    		}
    
        	document.addEventListener('DOMContentLoaded', () => {
            	const tb = document.querySelector('.table-scroll-1');
            	const bd = document.querySelector('body');
				const hg = window.innerHeight - 200;
            
				tb.style.overflowY  = "hidden";
            	tb.style.height     = "auto";
            	tb.style.maxHeight  = hg + "px";

				let scrollSpeed     = 30;
				let documentHeight  = tb.scrollHeight;
            

				let currentPosition = 0;

				function autoScroll() {
  					currentPosition += 1;
                	

  					if (currentPosition >= (tb.scrollHeight - tb.clientHeight)) {
            				currentPosition = 0;
            				loadscore();
            				documentHeight = tb.scrollHeight;
        			}
                
                	console.log(currentPosition);

  					tb.scrollTo(0, currentPosition);
				}

				setInterval(autoScroll, scrollSpeed);
            	loadscore();
            
            });

    	</script>
	<?php endif; ?>
    
<?php endif; ?>

</html>