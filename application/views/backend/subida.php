<?php template_set('title', 'Subir') ?>
<?php // echo $error;?>

<?php echo form_open_multipart('backend/juegos/subida/'.$id);?>

<input type="file" name="foto" size="20" />
<input type="hidden" name="hola" value="hola">
<br /><br />

<input name="subir" type="submit" value="upload" />

</form>
