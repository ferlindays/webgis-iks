function buildPopupView(data) {
  const table = document.createElement("table");
  table.className = "table table-striped table-bordered";

  const tbody = document.createElement("tbody");

  for (const key of ["faskes", "kalurahan", "padukuhan", "iks", "kategori"]) {
    const tr = document.createElement("tr");
    const th = document.createElement("th");
    th.textContent =
      key === "iks" ? "IKS" : key.charAt(0).toUpperCase() + key.slice(1);
    const td = document.createElement("td");
    td.textContent = data[key];

    tr.appendChild(th);
    tr.appendChild(td);
    tbody.appendChild(tr);
  }

  table.appendChild(tbody);

  return table;
}

function loadGeoJSON(data) {
  L.geoJSON(data, {
    style: function (feature) {
      const iks = feature.properties.iks;
      const color = iks < 0.5 ? "rgb(235,0,23)" : iks < 0.8 ? "rgb(255,110,87)" : "rgb(255,173,171)";

      return {
        weight: 2,
        opacity: 1,
        color: "white",
        dashArray: "3",
        fillOpacity: 0.5,
        fillColor: color,
      };
    },
    onEachFeature: function (feature, layer) {
      layer.bindPopup(buildPopupView(feature.properties));
    },
  }).addTo(map);
}

function clearMap(m) {
  for (i in m._layers) {
    if (m._layers[i]._path != undefined) {
      try {
        m.removeLayer(m._layers[i]);
      } catch (e) {
        console.log("problem with " + e + m._layers[i]);
      }
    }
  }
}
