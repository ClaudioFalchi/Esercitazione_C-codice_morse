<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Traduttore Morse</title>
    <!-- Includo Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0d6efd;
            min-height: 100vh;
        }
        h1 {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
<div class="text-center p-3 rounded bg-light" style="max-width: 400px; width:100%;">
    <h1>Traduttore Morse</h1>

    <form method="post" action="">
        <div class="mb-2">
            <label for="testo" class="form-label">Testo in chiaro:</label>
            <input type="text" id="testo" name="testo" class="form-control form-control-sm" placeholder="Inserisci testo"
                   value="<?php if(isset($_POST['testo'])) echo $_POST['testo']; ?>">
        </div>

        <div class="mb-2">
            <label for="morse" class="form-label">Testo in morse:</label>
            <input type="text" id="morse" name="morse" class="form-control form-control-sm" placeholder="Inserisci Morse"
                   value="<?php if(isset($_POST['morse'])) echo $_POST['morse']; ?>">
        </div>

        <div class="d-flex justify-content-center gap-2">
            <button type="submit" name="azione" value="▲" class="btn btn-primary btn-sm">▲</button> <!-- Morse -> Testo -->
            <button type="submit" name="azione" value="▼" class="btn btn-secondary btn-sm">▼</button> <!-- Testo -> Morse -->
        </div>
    </form>

    <?php
    $traduci = array(
        'A'=> '.-', 'B'=>'-...', 'C'=>'-.-.', 'D'=>'-..', 'E'=>'.', 'F'=>'..-.', 'G'=>'--.', 'H'=>'....', 'I'=>'..', 'J'=>'.---',
        'K'=>'-.-', 'L'=>'.-..', 'M'=>'--', 'N'=> '-.', 'O'=>'---', 'P'=>'.--.', 'Q'=>'--.-', 'R'=>'.-.', 'S'=>'...', 'T'=>'-',
        'U'=>'..-', 'V'=>'...-', 'W'=>'.--', 'X'=>'-..-', 'Y'=>'-.--', 'Z'=>'--..',
        '1'=>'.----', '2'=>'..---', '3'=>'...--', '4'=>'....-', '5'=>'.....',
        '6'=>'-....', '7'=>'--...', '8'=>'---..', '9'=>'----.', '0'=>'-----',
        ' '=> ' ' // lo spazio rimane spazio
    );

    if(isset($_POST['azione'])) {
        //Morse -> Testo
        if($_POST['azione'] == '▲' && !empty($_POST['morse'])) {
            $input = trim($_POST['morse']);
            $morse_inverse = array_flip($traduci);
            $testo = '';
            $parole_morse = explode('   ', $input); // parole separate da 3 spazi

            foreach($parole_morse as $parola) {
                $lettere = explode(' ', $parola);
                foreach($lettere as $l) {
                    if(isset($morse_inverse[$l])) {
                        $testo .= $morse_inverse[$l];
                    } else {
                        $testo .= ' ATTENZIONE: Stringa non conforme';
                    }
                }
                $testo .= ' ';
            }
            echo "<p class='mt-3'><strong>In Testo:</strong> $testo</p>";
        }

        //Testo -> Morse
        if($_POST['azione'] == '▼' && !empty($_POST['testo'])) {
            $input = strtoupper($_POST['testo']);
            $morse = '';
            for($i=0; $i<strlen($input); $i++) {
                $c = $input[$i];
                if(isset($traduci[$c])) {
                    $morse .= $traduci[$c] . ' ';
                }
            }
            $morse = str_replace('  ', '   ', $morse); // le parole le separo da 3 spazi
            echo "<p class='mt-3'><strong>In Morse:</strong> $morse</p>";
        }
    }
    ?>
</div>

<!-- Bootstrap  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
