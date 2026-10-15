/* Pemilih media bertahap: tiap pilih file ditambahkan ke daftar (bukan menimpa), bisa dihapus satuan. */
(function () {
  var input = document.getElementById('media');
  if (!input || !window.DataTransfer) return;
  var list = document.createElement('div');
  list.className = 'd-flex flex-wrap gap-3 mt-2';
  input.insertAdjacentElement('afterend', list);
  var dt = new DataTransfer();

  function render() {
    input.files = dt.files;
    list.innerHTML = '';
    Array.prototype.forEach.call(dt.files, function (f, i) {
      var box = document.createElement('div');
      box.className = 'text-center small position-relative';
      var el = document.createElement(f.type.indexOf('video/') === 0 ? 'video' : 'img');
      el.src = URL.createObjectURL(f); el.width = 120; el.muted = true;
      var b = document.createElement('button');
      b.type = 'button'; b.className = 'btn btn-sm btn-outline-danger d-block mx-auto mt-1'; b.textContent = 'Batal';
      b.onclick = function () {
        var n = new DataTransfer();
        Array.prototype.forEach.call(dt.files, function (x, k) { if (k !== i) n.items.add(x); });
        dt = n; render();
      };
      box.appendChild(el); box.appendChild(b); list.appendChild(box);
    });
  }

  input.addEventListener('change', function () {
    var picked = Array.prototype.slice.call(input.files);
    var cur = Array.prototype.slice.call(dt.files);
    picked.forEach(function (f) {
      var dup = cur.some(function (x) { return x.name === f.name && x.size === f.size; });
      if (!dup && dt.files.length < 20) dt.items.add(f);
    });
    render();
  });
})();
