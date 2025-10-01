<div class="container">
    <div class="">
        <div class="">
            <div class="row">
               <div class="col-sm-12">
					<div class="card align-self-center">
						<div class="table-responsive">
                   		<table id="table-head-1" class="table table-bordered">
							<tr></tr>
						</table>
                        </div>
						<div class="table-responsive table-scroll-1">
                   			<table id="table-score" class="table table-bordered" data-route="<?= $scoreRoute ?>">
								<thead class="text-uppercase sticky-top">
  									<tr class="fs-11 table-secondary">
    									<th rowspan="2" class="w-0">#</th>
    									<th rowspan="2" class="w-0">No. Peserta</th>
										<th rowspan="2" class="text-nowrap">Nama Peserta</th>
    									<th colspan="4" class="w-0 text-center">Tes Skolastik</th>
										<th colspan="4" class="w-0 text-center">Tes Literasi</th>
  									</tr>
  									<tr class="text-center fs-11 table-secondary border-top">
    									<th width="1%" class="text-nowrap text-center">KPU</th>
    									<th width="1%" class="text-nowrap text-center">PPU</th>
    									<th width="1%" class="text-nowrap text-center">KMBM</th>
    									<th width="1%" class="text-nowrap text-center">PK</th>
<th width="1%" class="text-nowrap text-center">LIT IND</th>
<th width="1%" class="text-nowrap text-center">LIT ING</th>
<th width="1%" class="text-nowrap text-center">PM</th>
  									</tr>
								</thead>
								<tbody></tbody>
								<!--
                                <thead class="text-uppercase fixed-thead">
                                	
  									<tr class="fs-11 table-secondary border-bottom">
                                		<th rowspan="2" class="w-0">#</th>
    									<th rowspan="2" class="w-0">No. Peserta</th>
										<th rowspan="2" class="text-nowrap">Nama Peserta</th>
                                
                               			<th width="1%" class="text-nowrap text-center">KPU</th>
    									<th width="1%" class="text-nowrap text-center">PPU</th>
    									<th width="1%" class="text-nowrap text-center">KMBM</th>
    									<th width="1%" class="text-nowrap text-center">PK</th>
<th width="1%" class="text-nowrap text-center">LIT IND</th>
<th width="1%" class="text-nowrap text-center">LIT ING</th>
<th width="1%" class="text-nowrap text-center">PM</th>
                               		
  									</tr>
                               		<tr class="text-center fs-11 table-secondary border-bottom">
    									<th colspan="7" class="w-0 text-center">Mata Uji</th>
  									</tr>
								</thead>
								-->
							</table>
						</div>
<!--
						<div>
							<table class="table table-bordered">
  <tr>
    <th colspan="2">Keterangan</th>
  </tr>

  <tr>
    <td width="1%" class="text-nowrap">KPU</td>
    <td>Kemampuan Penalaran Umum</td>
  </tr>
  <tr>
    <td width="1%" class="text-nowrap">PPU</td>
    <td>Pengetahuan dan Pemahaman Umum</td>
  </tr>
  <tr>
    <td width="1%" class="text-nowrap">KMBM</td>
    <td>Kemampuan Memahami Bacaan dan Menulis</td>
  </tr>
  <tr>
    <td width="1%" class="text-nowrap">PK</td>
    <td>Pengetahuan Kuantitatif</td>
  </tr>
  <tr>
    <td width="1%" class="text-nowrap">LIT IND</td>
    <td>Literasi dalam Bahasa Indonesia</td>
  </tr>
  <tr>
    <td width="1%" class="text-nowrap">LIT ING</td>
    <td>Literasi dalam Bahasa Inggris</td>
  </tr>
  <tr>
    <td width="1%" class="text-nowrap">PM</td>
    <td>Penalaran Matematika</td>
  </tr>
</table>
						</div>-->
						<div class="card-body d-flex justify-content-between">
							<span class="w-75">
							<strong>KPU</strong>: Kemampuan Penalaran Umum - <strong>PPU</strong>: Pengetahuan dan Pemahaman Umum - <strong>KMBM</strong>: Kemampuan Memahami Bacaan dan Menulis - <strong>PK</strong>: Pengetahuan Kuantitatif - <strong>LIT IND</strong>: Literasi dalam Bahasa Indonesia - <strong>LIT ING</strong>: Literasi dalam Bahasa Inggris - <strong>PM</strong>: Penalaran Matematika
							<span class="d-block mt-2"><strong>Jawaban Benar</strong> = 1 - <strong>Jawaban Salah</strong> = 0 - <strong>Tidak Menjawab</strong> = 0</span>
                            </span>
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