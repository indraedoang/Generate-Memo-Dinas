<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <p class="text-muted font-13 m-b-30">
                Detail Request Memo Dinas  
            </p>
            	<table class="table table_detail1-stripped table_detail">
					<tbody>
						<tr>
							<td>No Memo Dinas</td>
							<td>: <?=$MasterMemo->no_md?></td>
						</tr>

						<tr>
							<td>Requester</td>
							<td>: <?=get_employee_name();?> </td>
						</tr>
						<tr>
							<td>Perihal</td>
							<td>: <?=$MasterMemo->perihal?></td>
						</tr>
						<tr>
							<td>Tujuan</td>
							<td>: <?=$MasterMemo->tujuan?></td>
						</tr>
						<tr>
							<td>Keterangan</td>
							<td>: <?=$MasterMemo->keterangan?></td>
						</tr>
						<tr>
							<td>Module</td>
							<td>: <?=getModul($MasterMemo->modul)?></td>
						</tr>
						<tr>
							<td>Tanggal Request</td>
							<td>: <?=date('d M Y',strtotime($MasterMemo->tgl_request))?></td>
						</tr>
						<tr>
							<td>Dokument</td>
							<td>: <?=empty($MasterMemo->dokument) ? '-' :'<a href="'.base_url().'content/'. $MasterMemo->dokument.'">'. $MasterMemo->dokument.' </a>'?></td>
						</tr>
					</tbody>
				</table>
        </div>
    </div>
</div>