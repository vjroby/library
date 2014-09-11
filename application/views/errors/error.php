
                <?php if(DEBUG ): ?>
                    <p><?php echo $e->getMessage()?></p>
                    <p><b>The stack trace is as fallows</b></p>
                    <p><?php echo $e->getTraceAsString()?></p>
                    <p>The error:</p>
                    <?php print_r($e); ?>
                <?php endif; ?>
