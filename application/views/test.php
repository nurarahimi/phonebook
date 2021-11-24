<html lang="id">
<head>
	<meta charset="utf-8">
	<title>SEARCH CONTACT LIST</title>
	<!--Load file bootstrap.css-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
</head>
<body>

<div class="container">
	<h1>SEARCH <strong>CONTACT LIST</strong></h1>

	<table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php foreach ($data->result() as $row) :?>
                        <tr>
                    <td><?php echo $row->nim; ?></td>
                    <td><?php echo $row->nama; ?></td>
                    <td><?php echo $row->prodi; ?></td>
                </tr>
            <?php endforeach; ?>

                    </tbody>
	</table>
    <div class="row">
    	<div class="col">
    		<?php echo $pagination; ?>
    	</div>
    </div>
     

</div>
<!--Load file bootstrap.js-->
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
</body>
</html>