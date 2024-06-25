<?php if (!defined('ABSPATH')) die('Access denied'); ?>
<?php if (have_rows('resources_section')) : while (have_rows('resources_section')) : the_row();
  $title = get_sub_field('title');
  $data = get_boats_with_documents();
  $documents = $data['boats_with_docs'];
  $all_documents = $data['all_documents'];
  if ($title && !empty($documents)) :
?>
  <div class="owners-resources ps-rel ovf-h bg-light py-9">
    <div class="container">
      <div class="row ais gap-y-2">
        <div class="col-md-12 txt-ct wow animate__fadeIn">
          <h2 class="title mb-0 fwn"><?= $title ?></h2>
        </div>
        <div class="col-lg-12 flex flex-wrap gap-1 jcc wow animate__fadeInUp">
          <div class="col-md-3">
            <label class="sr-only" for="boat-select">Select Boat:</label>
            <select id="boat-select">
              <option value="">Select a Model</option>
              <option value="all">All Boats</option>
              <?php foreach ($documents as $boat_id => $boat_data) : ?>
                <option value="<?php echo esc_attr($boat_id); ?>"><?php echo esc_html($boat_data['title']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-3">
            <label class="sr-only" for="document-select">Select Document:</label>
            <select id="document-select">
              <option value="">Select a Resource Type</option>
              <option value="all">All Documents</option>
              <?php foreach ($all_documents as $doc_title => $doc_label) : ?>
                <option value="<?php echo esc_attr($doc_title); ?>"><?php echo esc_html($doc_label); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div id="document-content" class="col-lg-12 flex flex-wrap gap-1"></div>
      </div>
    </div>
  </div>

  <script>
    const boatsWithDocs = <?php echo json_encode($documents); ?>;
    const allDocuments = <?php echo json_encode($all_documents); ?>;
    const boatSelect = document.getElementById('boat-select');
    const documentSelect = document.getElementById('document-select');
    const documentContent = document.getElementById('document-content');

    function resetDropdowns() {
      boatSelect.innerHTML = '<option value="">Select a Model</option><option value="all">All Boats</option>';
      Object.keys(boatsWithDocs).forEach(boatId => {
        const option = document.createElement('option');
        option.value = boatId;
        option.textContent = boatsWithDocs[boatId].title;
        boatSelect.appendChild(option);
      });

      documentSelect.innerHTML = '<option value="">Select a Resource Type</option><option value="all">All Documents</option>';
      Object.keys(allDocuments).forEach(docTitle => {
        const option = document.createElement('option');
        option.value = docTitle;
        option.textContent = allDocuments[docTitle];
        documentSelect.appendChild(option);
      });

      documentContent.innerHTML = '';
    }

    boatSelect.addEventListener('change', function () {
      const selectedBoat = this.value;
      documentSelect.innerHTML = '<option value="">Select a Resource Type</option><option value="all">All Documents</option>';

      if (selectedBoat && selectedBoat !== 'all') {
        const documents = boatsWithDocs[selectedBoat].documents;
        for (const docTitle in documents) {
          const option = document.createElement('option');
          option.value = docTitle;
          option.textContent = documents[docTitle].label;
          documentSelect.appendChild(option);
        }
      } else {
        Object.keys(allDocuments).forEach(docTitle => {
          const option = document.createElement('option');
          option.value = docTitle;
          option.textContent = allDocuments[docTitle];
          documentSelect.appendChild(option);
        });
      }
    });

    documentSelect.addEventListener('change', function () {
      const selectedBoat = boatSelect.value;
      const selectedDoc = this.value;

      documentContent.innerHTML = '';

      if (selectedDoc === 'all') {
        Object.keys(boatsWithDocs).forEach(boatId => {
          const documents = boatsWithDocs[boatId].documents;
          for (const docTitle in documents) {
            const docData = documents[docTitle];
            documentContent.innerHTML += `<p class="mb-0 item"><a class="bg-white px-2 py-1 box-shadow-sm" href="${docData.file}" target="_blank"><b>${boatsWithDocs[boatId].title}</b>: ${docData.title}</a></p>`;
          }
        });
      } else if (selectedBoat === 'all') {
        Object.keys(boatsWithDocs).forEach(boatId => {
          const documents = boatsWithDocs[boatId].documents;
          if (selectedDoc in documents) {
            const docData = documents[selectedDoc];
            documentContent.innerHTML += `<p class="mb-0 item"><a class="bg-white px-2 py-1 box-shadow-sm" href="${docData.file}" target="_blank"><b>${boatsWithDocs[boatId].title}</b>: ${docData.title}</a></p>`;
          }
        });
      } else if (selectedBoat && selectedDoc === 'all') {
        const documents = boatsWithDocs[selectedBoat].documents;
        for (const docTitle in documents) {
          const docData = documents[docTitle];
          documentContent.innerHTML += `<p class="mb-0 item"><a class="bg-white px-2 py-1 box-shadow-sm" href="${docData.file}" target="_blank">${docData.title}</a></p>`;
        }
      } else if (selectedBoat && selectedDoc) {
        const docData = boatsWithDocs[selectedBoat].documents[selectedDoc];
        if (docData) {
          documentContent.innerHTML = `<p class="mb-0 item"><a class="bg-white px-2 py-1 box-shadow-sm" href="${docData.file}" target="_blank">${docData.title}</a></p>`;
        }
      } else if (selectedDoc) {
        Object.keys(boatsWithDocs).forEach(boatId => {
          const documents = boatsWithDocs[boatId].documents;
          if (selectedDoc in documents) {
            const docData = documents[selectedDoc];
            documentContent.innerHTML += `<p class="mb-0 item"><a class="bg-white px-2 py-1 box-shadow-sm" href="${docData.file}" target="_blank"><b>${boatsWithDocs[boatId].title}</b>: ${docData.title}</a></p>`;
          }
        });
      } else {
        resetDropdowns();
      }
    });

    // Inicializar o estado inicial dos dropdowns
    resetDropdowns();
  </script>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>