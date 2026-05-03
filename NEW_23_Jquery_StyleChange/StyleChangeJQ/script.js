$(document).ready(function() {
  function applyTheme(themeClass) {
    $('body').removeClass('theme-default theme-dark theme-bright');
    $('body').addClass(themeClass);
  }

  $('#theme-default').on('click', function() {
    applyTheme('theme-default');
  });

  $('#theme-dark').on('click', function() {
    applyTheme('theme-dark');
  });

  $('#theme-bright').on('click', function() {
    applyTheme('theme-bright');
  });

  $('#submit').on('click', function() {
    alert('Style applied to all controls successfully!');
  });

  applyTheme('theme-default');
});