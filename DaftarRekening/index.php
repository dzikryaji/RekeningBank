<!-- HTML B -->

<?php
require_once "../RekeningBank.php";
// Memasukkan 5 tuples
$tuples = [
	[
		"nama" => "Wayne Enterprise",
		"saldo" => 2_000_000_000,
		"jenis" => "Organisasi"
	],
	[
		"nama" => "Bruce Wayne",
		"saldo" => 1_000_000_000,
		"jenis" => "Pribadi"
	],
	[
		"nama" => "Richard Grayson",
		"saldo" => 5_000_000,
		"jenis" => "Pribadi"
	],
	[
		"nama" => "Jason Todd",
		"saldo" => 2_000_000,
		"jenis" => "Pribadi"
	],
	[
		"nama" => "Tim Drake",
		"saldo" => 8_000_000,
		"jenis" => "Pribadi"
	],
];
//Memasukkan 5 tuples
// insertTuples($tuples);

$table = getAllRekening();
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daftar Rekening</title>
	<link rel="stylesheet" href="table.css">
</head>

<body>
	<div class="main-container">
		<h1>Daftar Rekening</h2>
			<div class="btn-container">
				<form action="../Registerasi/">
					<input type="submit" value="Registrasi" class="btn form-btn">
				</form>
				<form action="../Transfer/">
					<input type="submit" value="Transfer" class="btn form-btn">
				</form>
			</div>
			<table>
				<tr>
					<th>ID</th>
					<th>No. Rekening</th>
					<th>Nama</th>
					<th>Saldo</th>
					<th>Jenis Rekening</th>
					<th>Edit</th>
				</tr>
				<?php
				foreach ($table as $row) {
					echo "<tr>",
					"<td>$row[id]</td>",
					"<td>$row[norek]</td>",
					"<td>$row[nama]</td>",
					"<td class='saldo'>$row[saldo]</td>",
					"<td>$row[jenis]</td>",
					"<td>
							<form action='../route.php' method='get'>
							<input type='hidden' name='delete' value='$row[id]'>
							<input type='submit' value='Delete' class='btn delete-btn'>
							</form>
					</td>",
					"</tr>";
				}
				?>
			</table>
	</div>
	<script src="index.js"></script>
</body>
</html>