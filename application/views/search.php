<div class ="container">
	<div class ="col-md-8">
		<div class ="col-md-12">	
			<div class ="row" style ="margin: 0; padding: 0;">
				<?php if (isset($docentes) || isset($trabalhos) || isset($disciplinas)) { ?>
					<h3>Search results for "<?php echo $term; ?>"</h3>
					<hr class ="style-eight">
					<?php 
						if (isset($docentes)) {
							foreach ($docentes as $docente) {
					?>
					<div class="row" style ="margin: 0; padding: 0;">
						<div class ="col-md-2" style ="margin: 0; padding: 0;">
							<p class ="tag" style="background-color: #FF481C;">Teacher</p>
						</div>
						<div class ="col-md-9">
							<p title ="<?php echo $docente->nome; ?>" class ="paragraph"><?php echo $docente->nome; ?>
								<?php if ($docente->website) { ?>
									<a href="<?php echo $docente->website;?>" target ="_blank">&nbsp&nbsp&nbsp<?php echo $docente->website;?></a>
								<?php } ?>
							</p>
						</div>
						<div class ="col-md-1" style ="margin: 0; padding: 0;">
							<a href="<?php echo base_url() . "index.php/docente/profile/" .$docente->docente_id;?>"><button class ="btn btn-xs pull-right btn-info">Show</button></a>
						</div>
					</div>
					<?php
						} }
					?>
					<?php 
						if (isset($trabalhos)) {
							foreach ($trabalhos as $trabalho) {
					?>
					<div class="row" style ="margin: 0; padding: 0;">
					<?php if ($this->trabalho_model->showVisibilidade($trabalho->visibilidade) == "Private" OR $trabalho->datarepositorio > date('Y-m-d H:i:s')) { ?>
						<div class ="col-md-2" style ="margin: 0; padding: 0;">
							<p class ="tag" style="background-color: #a1a1a1;">Private Work</p>
					<?php } else { ?>
						<div class ="col-md-2" style ="margin: 0; padding: 0;">
							<p class ="tag" style="background-color: #16C75E;">Work</p>
					<?php } ?>
						</div>
						<div class ="col-md-9">
							<p title ="<?php echo $trabalho->nome; ?>" class ="paragraph"><?php echo $trabalho->nome . " - <div class =\"bold\">" .
							$trabalho->tema . "</div> - " . $trabalho->datainicial; ?></p>
						</div>
						<div class ="col-md-1" style ="margin: 0; padding: 0;">
							<a href="<?php echo base_url() . "index.php/trabalho/profile/" .$trabalho->trabalho_id;?>"><button class ="btn btn-xs pull-right btn-info">Show</button></a>
						</div>
					</div>
					<?php
						} }
					?>
					<?php 
						if (isset($disciplinas)) {
							foreach ($disciplinas as $disciplina) {
					?>
					<div class="row" style ="margin: 0; padding: 0;">
					<div class ="col-md-2" style ="margin: 0; padding: 0;">
							<p class ="tag" style="background-color: #2365BA;">Class</p>
						</div>
						<div class ="col-md-9">
							<p title ="<?php echo $disciplina->nome; ?>" class ="paragraph"><?php echo $disciplina->nome . 
							" - <div class =\"bold\">" . $disciplina->instituicao . "</div> - " . $disciplina->curso; ?></p>
						</div>
						<div class ="col-md-1" style ="margin: 0; padding: 0;">
							<a href="<?php echo base_url() . "index.php/disciplina/profile/" .$disciplina->disciplina_id;?>"><button class ="btn btn-xs pull-right btn-info">Show</button></a>
						</div>
					</div>
					<?php
						} }
					?>
				<?php } else { ?>
					<h3>No search results for "<?php echo $term; ?>"</h3>
				<?php } ?>
				
			</div>
		</div>
	</div>
	<div class ="col-md-3 col-md-offset-1">
		<div class ="col-md-12">
			<div class ="row" style ="margin: 0; padding: 0;">
				<h3>Filter results</h3>
				<hr class ="style-eight">
				<div class="row" style ="margin: 0; padding: 0;">
					<a href="<?php echo base_url() . "index.php/frontpage/search?search=" . $term . "&filter=teacher"; ?>"><p class ="tag" style="background-color: #FF481C;">Teacher</p></a>
				</div>
				<div class="row" style ="margin: 0; padding: 0;">
					<a href="<?php echo base_url() . "index.php/frontpage/search?search=" . $term . "&filter=work"; ?>"><p class ="tag" style="background-color: #16C75E;">Work</p></a>
				</div>
				<div class="row" style ="margin: 0; padding: 0;">
					<a href="<?php echo base_url() . "index.php/frontpage/search?search=" . $term . "&filter=class"; ?>"><p class ="tag" style="background-color: #2365BA;">Class</p></a>
				</div>
			</div>
			<div class ="row" style ="margin: 0; padding: 0;">
				<h3>Suggested themes</h3>
				<hr class ="style-eight">
				<?php foreach ($temas as $tema) { ?>
					<div class="row" style ="margin: 0; padding: 0;">
						<a href="<?php echo base_url() . "index.php/frontpage/search?search=" . $tema->tema; ?>"><p class ="tag" style="background-color: #402A07;"><?php echo $tema->tema ?></p></a>
					</div>
				<?php } ?>
			</div>
			<div class ="row" style ="margin: 0; padding: 0;">
				<h3>Suggested teachers</h3>
				<hr class ="style-eight">
				<?php foreach ($teachers as $teacher) { ?>
					<div class="row" style ="margin: 0; padding: 0;">
						<a href="<?php echo base_url() . "index.php/docente/profile/" . $teacher->docente_id; ?>"><p class ="tag" style="background-color: #402A07;"><?php echo $teacher->nome ?></p></a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>