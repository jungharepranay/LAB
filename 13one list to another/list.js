$(document).ready(function () {
    // **Add a new item to List 1**
    $("#add-to-list1").click(function () {
      const newItemText = prompt("Enter the text for the new item:");
      if (newItemText) {
        $("<li></li>")
          .text(newItemText)
          .appendTo("#list1");
      }
    });
  
    // **Copy contents from List 1 to List 2**
    $("#copy-to-list2").click(function () {
      $("#list2").empty(); // Clear List 2
      $("#list1 li").clone().appendTo("#list2");
    });

    $("#copy-to-list1").click(function () {
      $("#list1").empty(); // Clear List 2
      $("#list2 li").clone().appendTo("#list1");
    });
  
    // **Add a new item to List 2**
    $("#add-new-item").click(function () {
      const newItemText = prompt("Enter the text for the new item:");
      if (newItemText) {
        $("<li></li>")
          .text(newItemText)
          .appendTo("#list2");
      }
    });
  
    // **Edit items in List 1**
    $(document).on("click", "#list1 li", function () {
      const currentText = $(this).text(); // Get the current text
      const newText = prompt("Edit item:", currentText); // Prompt for new text
      if (newText !== null) {
        $(this).text(newText); // Update the text
      }
    });
  
    // **Edit items in List 2**
    $(document).on("click", "#list2 li", function () {
      const currentText = $(this).text(); // Get the current text
      const newText = prompt("Edit item:", currentText); // Prompt for new text
      if (newText !== null) {
        $(this).text(newText); // Update the text
      }
    });
  
    // **Delete all items in List 1**
    $("#delete-list1").click(function () {
      if (confirm("Are you sure you want to delete all items in List 1?")) {
        $("#list1").empty();
      }
    });
  
    // **Delete all items in List 2**
    $("#delete-list2").click(function () {
      if (confirm("Are you sure you want to delete all items in List 2?")) {
        $("#list2").empty();
      }
    });
  });
  