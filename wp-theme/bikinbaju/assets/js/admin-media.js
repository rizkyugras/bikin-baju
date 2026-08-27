// Media uploader untuk field gambar produk di editor halaman
(function ($) {
  "use strict";
  $(document).on("click", ".bb-pick-image", function (e) {
    e.preventDefault();
    var target = $(this).data("target");
    var field = $("#" + target);
    var frame = wp.media({
      title: "Pilih gambar produk",
      multiple: false,
      library: { type: "image" },
    });
    frame.on("select", function () {
      var attachment = frame.state().get("selection").first().toJSON();
      field.val(attachment.url).trigger("change");
    });
    frame.open();
  });
})(jQuery);