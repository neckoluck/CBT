<div class="container">
    <div class="">
        <div class="">
            <div class="row">
               <div class="col-sm-12">
					<div class="card align-self-center">
						<div class="table-responsive">
                   		<table class="table table-bordered">
							<tr>
    							<td class="fs-12 fw-500 text-nowrap">
									Live Score CBT Politeknik Negeri Kupang <?=date('Y')?>
									<span class="d-block fw-400 fs-11">Tanggal. 21/06/2003</span>
								</td>
                                <td class="fs-12 fw-400 text-nowrap">
									sesi - jam:
									<span class="d-block fw-600">SESI 1 - 10.00 - Selesai</span>
								</td>
  							</tr>
						</table>
                        </div>
						<div class="table-responsive table-scroll-1">
                   			<table id="table-score" class="table table-bordered" data-route="<?= $scoreRoute ?>">
								<thead class="text-uppercase">
  									<tr class="fs-11 table-secondary">
    									<th rowspan="2" class="w-0">#</th>
    									<th rowspan="2" class="w-0">No. Peserta</th>
										<th rowspan="2" class="text-nowrap">Nama Peserta</th>
    									<th colspan="4" class="w-0 text-center">Mata Uji</th>
  									</tr>
  									<tr class="text-center fs-11 table-secondary border-top">
    									<th class="w-0 text-center">MTK</th>
    									<th class="w-0 text-center">BINDO</th>
    									<th class="w-0 text-center">BING</th>
    									<th class="w-0 text-center">Skolas</th>
  									</tr>
								</thead>
								<tbody>
								<?php for ($i = 1; $i <= 10; $i++) : ?>
  									<tr class="fs-11">
    									<td style="width:0px" class="fw-500"><?=$i?>.</td>
 										<td class="text-nowrap fw-500" style="width:0px">UTBK3-023-00203</td>
    									<td class="text-nowrap text-uppercase fw-500">Putra Mahalindo Maisal</td>
   										<td style="width:0px" class="fw-500 text-center">-20</td>
    									<td style="width:0px" class="fw-500 text-center">-20</td>
    									<td style="width:0px" class="fw-500 text-center">-20</td>
    									<td style="width:0px" class="fw-500 text-center">-20</td>
  									</tr>
								<?php endfor; ?>
                                <?php 
                                    	$no = 0;
                    					foreach ($rows as $row) :
										$no++;
                                   	?>
   									<tr class="fs-11">
     									<td style="width:0px" class="fw-500"><?=$no?>.</td>
  										<td class="text-nowrap fw-500" style="width:0px"><?= strtoupper($row['no_pendaftaran']); ?></td>
     									<td class="text-nowrap text-uppercase fw-500"><?= strtoupper($row['nama_peserta']); ?></td>
   										
     									<td style="width:0px" class="fw-500 text-center"><?= $row['Matematika']; ?></td>
                                     	<td style="width:0px" class="fw-500 text-center"><?= $row['Indonesia']; ?></td>
     									<td style="width:0px" class="fw-500 text-center"><?= $row['Inggris']; ?></td>
                                     	<td style="width:0px" class="fw-500 text-center"><?= $row['Skolastik']; ?></td>
   									</tr>
								<?php endforeach; ?>
								</tbody>
                                <thead class="text-uppercase fixed-thead">
                                	
  									<tr class="fs-11 table-secondary border-bottom">
                                		<th rowspan="2" class="w-0">#</th>
    									<th rowspan="2" class="w-0">No. Peserta</th>
										<th rowspan="2" class="text-nowrap">Nama Peserta</th>
                                
                               			<th class="w-0 text-center">MTK</th>
    									<th class="w-0 text-center">BINDO</th>
    									<th class="w-0 text-center">BING</th>
    									<th class="w-0 text-center">Skolas</th>
                               		
  									</tr>
                               		<tr class="text-center fs-11 table-secondary border-bottom">
    									<th colspan="4" class="w-0 text-center">Mata Uji</th>
  									</tr>
								</thead>
							</table>
						</div>
						<div class="card-body d-flex justify-content-end">
                        	 <span class="form-text text-dark fn-inter fs-12 fw-500">
                 				CBT <?= date('Y') ?> &copy; Politeknik Negeri Kupang
                 				<span class="d-block fw-400 fs-9 mt-0">CREATED BY ICTPNKTEAM</span>
            				 </span>        
                        </div>
                	</div>
			   </div>
            </div>
        </div>

    </div>
</div>