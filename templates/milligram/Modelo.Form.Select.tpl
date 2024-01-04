			<label for="%%CAMPO%%">%%CLASSE_FK%%</label>
			<select name="%%CAMPO%%" id="%%CAMPO%%">
				<option value="">Selecione</option>
			<?php
			foreach($a%%CLASSE_FK%% as $o%%CLASSE_FK%%){
				if(%%CLASSE%% != NULL)
				        $selected =  (%%EDIT_VALUE%%) ? " selected" : "";
				    else
				        $selected = "";
			?>
				<option value="<?=$o%%CLASSE_FK%%->%%CAMPO_FK%%?>"<?=$selected?>><?=$o%%CLASSE_FK%%->%%LABEL_FK%%?></option>
			<?php
			}
			?>
			</select>