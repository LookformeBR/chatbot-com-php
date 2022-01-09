<?php
// conectando ao banco de dados
$conn = mysqli_connect("localhost", "root", "", "chatbot") or die("Database Error");
$conn->set_charset("utf8");

// recebendo mensagem do usuário por meio de ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

// verificando a consulta do usuário para a consulta do banco de dados
$check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");

// se a consulta do usuário corresponder à consulta do banco de dados, mostraremos a resposta, caso contrário, iremos para a instrução else
if(mysqli_num_rows($run_query) > 0){
    // buscando reprodução do banco de dados de acordo com a consulta do usuário
    $fetch_data = mysqli_fetch_assoc($run_query);
   // armazenando replay em uma variável que enviaremos para ajax
    $replay = $fetch_data['replies'];
    echo $replay;
}else{
    echo "Desculpe, não entendi o que voce digitou.";
}

?>