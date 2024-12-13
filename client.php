<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traducteur Anglais-Darija</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h1>Traducteur Anglais vers Darija</h1>
        <form method="POST" action="">
            <div class="translation-wrapper">
                <div class="form-group">
                    <label for="text-english">Texte en anglais :</label>
                    <textarea id="text-english" name="text" placeholder="Écrivez en anglais ici..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="text-darija">Traduction en Darija :</label>
                    <?php
                        
                        $output = "";

                        
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['text'])) {
                           
                            $EnglishText = $_POST['text'];
                            
                          
                            $translatorUrl = "http://localhost:8082/REST-web-java/rest/traduction";
                            
                            
                            $data = $EnglishText;
                            
                           
                            $options = [
                                "http" => [
                                    "header" => "Content-type: text/plain\r\n", 
                                    "method" => "POST", 
                                    "content" => $data, 
                                ]
                            ];
                            
                           
                            $context = stream_context_create($options);

                            
                            $response = @file_get_contents($translatorUrl, false, $context);

                            
                            if ($response === FALSE) { 
                                $output = "Erreur : Impossible de traduire la phrase."; 
                            } else { 
                                $output = htmlspecialchars($response); 
                            }
                        }
                        ?>

                        <textarea id="text-darija" placeholder="La traduction apparaîtra ici..." readonly><?php echo $output; ?></textarea>

                </div>
            </div>
            <button type="submit" class="btn">Traduire</button>
        </form>
    </div>
</body>
</html>
