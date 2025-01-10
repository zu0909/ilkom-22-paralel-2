 <?php
    // Helper function to wrap mentions with a span tag code
    function highlightMentions($text) {
        // Regex pattern to detect mentions (e.g., @username)
        $pattern = '/@(\w+)/';
        
        // Replace mentions with a styled span tag
        $replacement = '<span class="mention">@\1</span>';
        return preg_replace($pattern, $replacement, htmlspecialchars($text));
    }

    // Process form submission
    $inputText = '';
    $processedText = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputText = $_POST['text'] ?? '';
        $processedText = highlightMentions($inputText);
    }
    ?>

    <form action="" method="post">
        <label for="text">Enter your text:</label><br>
        <textarea name="text" id="text" placeholder="Type @username to mention someone..."><?= htmlspecialchars($inputText) ?></textarea><br>
        <button type="submit">Process</button>
    </form>

    <?php if ($processedText): ?>
        <h2>Processed Text</h2>
        <p>Original Text:</p>
        <blockquote><?= nl2br(htmlspecialchars($inputText)) ?></blockquote>
        <p>Processed Text:</p>
        <blockquote><?= nl2br($processedText) ?></blockquote>
    <?php endif; ?>
</body>
</html>
