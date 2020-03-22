<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	require '../classess/Brand.php';


	$brand   	= new Brand();
	$list 		= $brand -> get_all_brand();

	if(isset($_GET['id']))
	{
		$id 		= $_GET['id'];
		$is_deleted = $brand -> delete($id);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
					<?php
						if(isset($is_deleted))
						{
							echo $is_deleted;
						}
					?>         
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if($list)
						{
							$i = 0;
							while($data = $list->fetch_assoc())
							{ $i++; 
						?>
							<tr class="odd gradeX">
								<td><?= $i; ?></td>
								<td><?= $data['name']; ?></td>
								<td><a href="editBrand.php?id=<?= $data['id']?>">Edit</a> || 
								<a onclick="return confirm('Are you Confirm To Delete?')" href="?id=<?= $data['id'];?>">Delete</a></td>
							</tr>
							<?php
							}
						}
					?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

