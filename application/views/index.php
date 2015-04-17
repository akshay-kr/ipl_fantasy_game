<html>
    <head>
        <?php $this->load->view("templates/head"); ?>
    </head>
    <body>
        <!-- BEGIN wrapper -->
        <div id="wrapper">
            <?php $this->load->view("templates/navbar"); ?>
            <?php $this->load->view("templates/sidebar"); ?>
            <?php $this->load->view("content/$content"); ?>
            <?php $this->load->view("templates/footer"); ?>
        </div>
        <!-- END wrapper -->
    </body>
    <?php $this->load->view("templates/javascripts"); ?>
</html>
