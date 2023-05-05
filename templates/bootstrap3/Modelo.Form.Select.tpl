<div class="col-md-4">
	<div class="form-group">
		<label for="%%CAMPO%%">%%CLASSE_FK%%</label>
		<select class="form-control" name="%%CAMPO%%" id="%%CAMPO%%">
			<option value="">Selecione</option>
		<?php
		foreach($a%%CLASSE_FK%% as $o%%CLASSE_FK%%){
		?>
			<option value="<?=$o%%CLASSE_FK%%->%%CAMPO_FK%%?>"%%EDIT_VALUE%%><?=$o%%CLASSE_FK%%->%%LABEL_FK%%?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>