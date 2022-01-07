<?php
	include 'functions.php';// incluir o arquivo de funções
	$platform = 'pc';// definir a plataforma
	$epicNickname = 'Ninja';// definir o nome de usuário
	/*$epic = 'Ninja';// definir o nome de usuário
	$region = 'NAE';// definir a região*/
	$playerStats = getPlayerStats( $platform, $epicNickname );// chamar a função para pegar as estatísticas do jogador
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Fortnite Player Stats</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<style>
			@font-face{
				font-family: 'Fortnite';
				src: url( 'BurbankBigCondensed-Bold.otf' );
			}
			body{
				font-family: 'Fortnite';
				background: #1e1e1e;
				color: #fff;
				padding: 10px;
			}
		</style>
	</head>
	<body>
		<div style="margin-bottom:20px;font-size:48px">
			<div>Fortnite: Estatísticas do jogador</div>
			<div style="font-size:28px;">
				Jogador <?php echo $epicNickname; ?> no <?php echo $platform; ?>
			</div>
		</div>
		<div style="width:100%;color:#000;background:#f1ed62;font-size:26px;display:inline-block">
			<div style="padding:5px">
				<div style="float:left">Lifetime</div>
			</div>
		</div>
		<ul style="list-style: none;padding:0px;margin:0px;margin:0px;margin-bottom:20px">
			<?php foreach ( $playerStats['lifeTimeStats'] as $stat ) : ?>
			<li style="display:inline-block;border:1px solid #363636;padding:10px;margin-left:10px;margin-top:10px">
				<div>
					<div style="color:#9a9a9a;font-size: 16px;">
						<?php echo $stat['key']; ?>
					</div>
					<div style="font-size:22px">
						<?php echo $stat['value']; ?>
					</div>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
		<div style="width:100%;color:#000;background:#f1ed62;font-size:26px;display:inline-block">
			<div style="padding:5px">
				<div style="float:left">Solos</div>
			</div>
		</div>
		<ul style="list-style: none;padding:0px;margin:0px;margin:0px;margin-bottom:20px">
			<?php foreach ( $playerStats['stats']['p2'] as $stat ) : ?>
				<?php if ( $stat['value'] ) : ?>
					<li style="display:inline-block;border:1px solid #363636;padding:10px;margin-left:10px;margin-top:10px">
						<div>
							<div style="color:#9a9a9a;font-size: 16px;">
								<?php echo $stat['label']; ?>
							</div>
							<div style="font-size:22px">
								<?php echo $stat['displayValue']; ?>
							</div>
							<div style="color:#9a9a9a;font-size:14px;margin-top:5px;">
								Rank
							</div>
							<div style="font-size:18px">
								<?php if ( isset( $stat['rank'] ) ) : ?>
									<?php echo number_format( $stat['rank'] ); ?>
								<?php else : ?>
									-
								<?php endif; ?>
							</div>
						</div>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<div style="width:100%;color:#000;background:#f1ed62;font-size:26px;display:inline-block">
			<div style="padding:5px">
				<div style="float:left">Duos</div>
			</div>
		</div>
		<ul style="list-style: none;padding:0px;margin:0px;margin:0px;margin-bottom:20px">
			<?php foreach ( $playerStats['stats']['p10'] as $stat ) : ?>
				<?php if ( $stat['value'] ) : ?>
					<li style="display:inline-block;border:1px solid #363636;padding:10px;margin-left:10px;margin-top:10px">
						<div>
							<div style="color:#9a9a9a;font-size: 16px;">
								<?php echo $stat['label']; ?>
							</div>
							<div style="font-size:22px">
								<?php echo $stat['displayValue']; ?>
							</div>
							<div style="color:#9a9a9a;font-size:14px;margin-top:5px;">
								Rank
							</div>
							<div style="font-size:18px">
								<?php if ( isset( $stat['rank'] ) ) : ?>
									#<?php echo number_format( $stat['rank'] ); ?>
								<?php else : ?>
									-
								<?php endif; ?>
							</div>
						</div>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<div style="width:100%;color:#000;background:#f1ed62;font-size:26px;display:inline-block">
			<div style="padding:5px">
				<div style="float:left">Squads</div>
			</div>
		</div>
		<ul style="list-style: none;padding:0px;margin:0px;margin:0px;margin-bottom:20px">
			<?php foreach ( $playerStats['stats']['p9'] as $stat ) : ?>
				<?php if ( $stat['value'] ) : ?>
					<li style="display:inline-block;border:1px solid #363636;padding:10px;margin-left:10px;margin-top:10px">
						<div>
							<div style="color:#9a9a9a;font-size: 16px;">
								<?php echo $stat['label']; ?>
							</div>
							<div style="font-size:22px">
								<?php echo $stat['displayValue']; ?>
							</div>
							<div style="color:#9a9a9a;font-size:14px;margin-top:5px;">
								Rank
							</div>
							<div style="font-size:18px">
								<?php if ( isset( $stat['rank'] ) ) : ?>
									#<?php echo number_format( $stat['rank'] ); ?>
								<?php else : ?>
									-
								<?php endif; ?>
							</div>
						</div>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</body>
</html>