<div class ="container">
  <h3>Admin</h3>
    <div class ="col-md-8">

	<h1>Uploads File Tree</h1>

	<style type="text/css">
		div {
			font: 14px/18ox Arial;
		}

		.folder {
			background-image: url(<?php echo base_url() ?>/assets/img/folder.png);
			background-repeat: no-repeat;
		}

		.file {
			background-image: url(<?php echo base_url() ?>/assets/img/file.png);
			background-repeat: no-repeat;
		}
		ul {
			list-style: none;
			cursor: pointer;
			padding-left: 20px;
		}

		li {
			padding-left: 20px;
			margin: 2px;
		}
	</style>
	<div id="files">

	</div>

	<script>
		$(document).ready(function() {
			var files = <?php echo json_encode($files); ?>;
			var file_tree = build_file_tree(files);
			file_tree.appendTo('#files');


			function build_file_tree(files) {

				var tree = $('<ul>');
				for (x in files) {

					if (typeof files[x] == "object") {
						var span = $('<span>').html(x).appendTo(
							$('<li>').appendTo(tree).addClass('folder')
							);

						var subtree = build_file_tree(files[x]).hide();
						span.after(subtree);
						span.click(function() {
							$(this).parent().find('ul:first').toggle();
						});
					} 
					else {
						$('<li>').html(files[x]).appendTo(tree).addClass('file');
					}
				}

				return tree;
			}
		});
	</script>
    </div>
</div>