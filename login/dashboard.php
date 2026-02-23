<?php 
    include 'partial/header.php'; 
    include 'partial/nav.php'; 
    
    if(!isLoggedIn()){
        redirect('login.php');
    }
?>
<main>  
    <h1>Dashboard</h1>
</main>
<?php include 'partial/footer.php'; ?>