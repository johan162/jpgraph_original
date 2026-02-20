<?php
try {

    $graph = new Graph($width,$height);

    // ... Code to setup the graph

    if( /* some error condition */ ) {
        throw new JpGraphException(' ... some error message ...');
    }

} catch ( JpGraphException $e ) {
    // .. do necessary cleanup

    // Send back error message
    $e->Stroke();
}
?>
