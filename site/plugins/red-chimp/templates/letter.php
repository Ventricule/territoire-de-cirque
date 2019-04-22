<?php if($user = $site->user()): ?>
  <div style="text-align: center;position: fixed;width: 100%;background: #fff;padding: 20px 5%;box-shadow: 0 0 10px rgba(0,0,0,.2);bottom: 0;display: flex;box-sizing: border-box;">
    <button id="copyButton" style="cursor: pointer;flex: 1;border: 1px solid;font-size: 12px;text-decoration: none;color: #001abb;background: #fff;height: 40px;">1 — Copier le code HTML</button>
    <textarea id="copyTarget" style="cursor: pointer;height: 40px;border: 1px solid;font-size: 12px;color: #001abb;padding: 0;margin: 0;opacity: 0;width: 40px;">
      <?php snippet('letter-header') ?>
        <?php foreach($page->builder()->toStructure() as $section): ?>
          <?php snippet('builder/' . $section->_fieldset(), array('data' => $section)) ?>
        <?php endforeach ?>
      <?php snippet('letter-footer') ?>
    </textarea>
    <a href="https://htmlemail.io/inline/" target="_blank" style="cursor: pointer;flex: 1;border: 1px solid;line-height: 40px;font-size: 12px;text-decoration: none;color: #001abb;height: 40px;">2 — Convertir le code</a>
  </div>
<?php endif; ?>


<?php snippet('letter-header') ?>
  <?php foreach($page->builder()->toStructure() as $section): ?>
    <?php snippet('builder/' . $section->_fieldset(), array('data' => $section)) ?>
  <?php endforeach ?>
<?php snippet('letter-footer') ?>

<script>
  document.getElementById("copyButton").addEventListener("click", function() {
      copyToClipboard(document.getElementById("copyTarget"));
  });

  function copyToClipboard(elem) {
  	  // create hidden text element, if it doesn't already exist
      var targetId = "_hiddenCopyText_";
      var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
      var origSelectionStart, origSelectionEnd;
      if (isInput) {
          // can just use the original source element for the selection and copy
          target = elem;
          origSelectionStart = elem.selectionStart;
          origSelectionEnd = elem.selectionEnd;
      } else {
          // must use a temporary form element for the selection and copy
          target = document.getElementById(targetId);
          if (!target) {
              var target = document.createElement("textarea");
              target.style.position = "absolute";
              target.style.left = "-9999px";
              target.style.top = "0";
              target.id = targetId;
              document.body.appendChild(target);
          }
          target.textContent = elem.textContent;
      }
      // select the content
      var currentFocus = document.activeElement;
      target.focus();
      target.setSelectionRange(0, target.value.length);

      // copy the selection
      var succeed;
      try {
      	  succeed = document.execCommand("copy");
      } catch(e) {
          succeed = false;
      }
      // restore original focus
      if (currentFocus && typeof currentFocus.focus === "function") {
          currentFocus.focus();
      }

      if (isInput) {
          // restore prior selection
          elem.setSelectionRange(origSelectionStart, origSelectionEnd);
      } else {
          // clear temporary content
          target.textContent = "";
      }
      return succeed;
  }
</script>
