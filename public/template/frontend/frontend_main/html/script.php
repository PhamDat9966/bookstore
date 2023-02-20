<?php 
    echo $this->_jsFile;
    //echo $this->_pluginsJs;
?>
<script>
    function openSearch() {
        document.getElementById("search-overlay").style.display = "block";
        document.getElementById("search-input").focus();
    }

    function closeSearch() {
        document.getElementById("search-overlay").style.display = "none";
    }
</script>