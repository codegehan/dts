<?php
class PDFSignature {
private $documentName;
private $documentPath;
private $signaturePath;

public function __construct($documentName, $documentPath, $signatureImage, $signedBy, $recordNo, $redirectURL) {
$this->documentName = htmlspecialchars($documentName);
$this->documentPath = $documentPath . $this->documentName;
$this->signatureImage = $signatureImage;
$this->signedBy = $signedBy;
$this->recordNo = $recordNo;
$this->redirect = $redirectURL;
}
public function render() {
if (!file_exists($this->documentPath)) {
    echo "Error: File not found.";
    return false;
}
$fileContent = file_get_contents($this->documentPath);
$signContent = file_get_contents($this->signatureImage);
$docName = $this->documentName;
$signaturedBy = $this->signedBy;
$recNo = $this->recordNo;
$urlRed = $this->redirect;
$fileContentBase64 = base64_encode($fileContent);
$signContentBase64 = base64_encode($signContent);
echo <<<HTML
<style>
#pdfCanvas {
display: block;
margin: 0 auto; /* Center the canvas horizontally */
border: 1px solid #000;
}
.bottom-btn{
padding: 8px 16px;
font-size: 2rem;
}
button:hover{
cursor: pointer;
}
#buttonCont-pdf{
position: fixed;
bottom: 0;
left:50%;
transform: translateX(-50%); /* Center horizontally */
text-align: center; /* Center text inside buttons */
margin: 10px auto; /* Add margin to top and bottom */
}
</style>
<input type="file" id="pdfInput" accept="application/pdf" style="display:none;">
<div style="text-align:center;margin-bottom:80px;">
<canvas id="pdfCanvas"></canvas>
</div>
<div id="navigation" style="display:none;">
    <button id="prevPage" style="font-size:18px;">Previous</button>
    <span>Page: <span id="pageNumber">1</span> / <span id="totalPages"></span></span>
    <button id="nextPage" style="font-size:18px;">Next</button>
</div>
<div id="buttonCont-pdf" style="margin-top:10px;text-align:center;">
    <button id="signButton" class="bottom-btn" style="background-color:blue;color:#fff;">Add Signature</button>
    <button id="saveButton" class="bottom-btn" style="background-color:green;color:#fff;">Save PDF</button>
    <button id="clearButton" class="bottom-btn" style="background-color:red;color:#fff;">Clear</button>
</div>
<script src="../pdfSign/pdf-lib.min.js"></script>
<script src="../pdfSign/pdf.min.js"></script>
<script>
pdfjsLib.GlobalWorkerOptions.workerSrc = '../pdfSign/pdf.worker.min.js';
const pdfInput = document.getElementById('pdfInput');
const pdfCanvas = document.getElementById('pdfCanvas');
const signButton = document.getElementById('signButton');
const saveButton = document.getElementById('saveButton');
const clearButton = document.getElementById('clearButton');
const prevPageButton = document.getElementById('prevPage');
const nextPageButton = document.getElementById('nextPage');
const pageNumberDisplay = document.getElementById('pageNumber');
const totalPagesDisplay = document.getElementById('totalPages');
let pdfDoc = null;
let pdfBytes = null;
let pdfContext = pdfCanvas.getContext('2d');
let renderedPdf = null;
let currentPage = 1;
let totalPages = 0;
let pdfScale = 1;
let signatures = [];
let signatureImg = new Image();
signatureImg.src = "data:image/png;base64,{$signContentBase64}";
async function loadPdf(pdfData) {
    pdfDoc = await PDFLib.PDFDocument.load(pdfData);
    const loadingTask = pdfjsLib.getDocument({ data: pdfData });
    renderedPdf = await loadingTask.promise;
    totalPages = renderedPdf.numPages;
    totalPagesDisplay.textContent = totalPages;
    const navigationElement = document.getElementById("navigation");
    if (totalPages > 1) {
        navigationElement.style.display = 'inline-block';
    } else {
        navigationElement.style.display = 'none';
    }
    renderPage(currentPage);
}
document.addEventListener('DOMContentLoaded', async () => {
    const fileDataUrl = 'data:application/pdf;base64,{$fileContentBase64}';
    const response = await fetch(fileDataUrl);
    pdfBytes = await response.arrayBuffer();
    await loadPdf(pdfBytes);
    pdfInput.style.display = 'none';
});
clearButton.addEventListener('click', async (e) => {
    try {
        signatures = [];
        const fileDataUrl = 'data:application/pdf;base64,{$fileContentBase64}';
        const response = await fetch(fileDataUrl);
        pdfBytes = await response.arrayBuffer();
        await loadPdf(pdfBytes);
        pdfInput.style.display = 'none';
        pdfContext.clearRect(0, 0, pdfCanvas.width, pdfCanvas.height);
    } catch (error) {
        console.error('Error clearing signatures:', error);
        return false;
    }
});
pdfInput.addEventListener('change', async (e) => {
    pdfContext.clearRect(0, 0, pdfCanvas.width, pdfCanvas.height);
    const file = e.target.files[0];
    if (!file) {
        return false;
    }
    try {
        pdfBytes = await file.arrayBuffer();
        await loadPdf(pdfBytes);
    } catch (error) {
        console.error('Error loading PDF:', error);
        return false;
    }
});
signButton.addEventListener('click', () => {
    pdfCanvas.addEventListener('click', addSignature);
    pdfCanvas.style.cursor = 'crosshair';
});
async function addSignature(event) {
    if (!pdfDoc) return false;
    const rect = pdfCanvas.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;  
    try {
        const imgWidth = 100;
        const imgHeight = 50;
        const xPosition = (x / pdfScale);
        const yPosition = (pdfCanvas.height - y) / pdfScale;      
        const signatureText = `Digital Signed By: {$signaturedBy}\nRec.No: {$recNo}`;
        const textMargin = 10;    
        signatures.push({
            page: currentPage,
            x: xPosition - imgWidth / 2,
            y: yPosition - imgHeight / 2,
            width: imgWidth,
            height: imgHeight,
            hintText: signatureText,
            textMargin: textMargin
        });  
        await renderPage(currentPage);
    } catch (error) {
        console.error('Error adding signature:', error);
        return false;
    }
    pdfCanvas.removeEventListener('click', addSignature);
    pdfCanvas.style.cursor = 'default';
}
saveButton.addEventListener('click', async () => {
    if (!pdfDoc) return false;
    try {
        // Embed the signature image
        const pngImage = await pdfDoc.embedPng(await fetch(signatureImg.src).then(res => res.arrayBuffer()));

        // Draw the signature and hint text on the PDF
        signatures.forEach(sig => {
            const page = pdfDoc.getPages()[sig.page - 1];

            // Draw the signature image
            page.drawImage(pngImage, {
                x: sig.x,
                y: sig.y,
                width: sig.width,
                height: sig.height,
            });
            // Draw the hint text
            const textX = sig.x; // Center text under the image
            const textY = sig.y - sig.textMargin; // Adjust based on image height and text size
            const lines = sig.hintText.split(`\n`);

            lines.forEach((line, index) => {
                page.drawText(line, {
                    x: textX,
                    y: textY - index * 10, // Adjust vertical position for each line
                    size: 8, // Font size
                    align: 'center'
                });
            });
        });
        // Save the updated PDF
        const newPdfBytes = await pdfDoc.save();
        // Create FormData to send PDF bytes to server
        const formData = new FormData();
        formData.append('file', new Blob([newPdfBytes], { type: 'application/pdf' }));
        formData.append('fileName', '{$docName}');
        formData.append('recordNo', '{$recNo}');
        // Send the PDF data to the server
        const response = await fetch('../pdfSign/savepdf.php', {
            method: 'POST',
            body: formData
        });
        // Check the response
        const responseText = await response.text();
        if (response.ok) {
            alert('PDF has been saved successfully! Response: ' + responseText);
            window.location.href="{$urlRed}";
        } else {
            console.log('Failed to save PDF. Response: ' + responseText)
            return false;
        }
    } catch (error) {
        console.error('Error saving PDF:', error);
        return false;
    }
});
async function renderPage(pageNumber) {
if (!renderedPdf || pageNumber < 1 || pageNumber > totalPages) {
    console.error('Invalid page request or PDF not loaded');
    return false;
}
try {
    pdfContext.clearRect(0, 0, pdfCanvas.width, pdfCanvas.height);
    const page = await renderedPdf.getPage(pageNumber);
    const viewport = page.getViewport({ scale: 1.5 });
    pdfCanvas.width = viewport.width;
    pdfCanvas.height = viewport.height;
    pdfScale = viewport.scale;
    const renderContext = {
        canvasContext: pdfContext,
        viewport: viewport
    };
    await page.render(renderContext).promise;
    signatures.forEach(sig => {
        if (sig.page === pageNumber) {
            pdfContext.drawImage(signatureImg, sig.x * pdfScale, (viewport.height / pdfScale - sig.y - sig.height) * pdfScale, sig.width * pdfScale, sig.height * pdfScale);
            pdfContext.font = '10px Arial';
            pdfContext.fillStyle = 'black';
            pdfContext.textAlign = 'center';
            const textX = sig.x * pdfScale + sig.width * pdfScale / 2;
            const textY = (viewport.height / pdfScale - sig.y - sig.height) * pdfScale + sig.height * pdfScale + sig.textMargin;
            const lines = sig.hintText.split(`\n`);
            lines.forEach((line, index) => {
                pdfContext.fillText(line, textX, textY + index * 15);
            });
        }
    });
    pageNumberDisplay.textContent = pageNumber;
} catch (error) {
    console.error('Error rendering page:', error);
}
}
prevPageButton.addEventListener('click', () => {
    if (currentPage <= 1) return false;
    currentPage--;
    renderPage(currentPage);
});
nextPageButton.addEventListener('click', () => {
    if (currentPage >= totalPages) return false;
    currentPage++;
    renderPage(currentPage);
});
</script>
HTML;

     return true;
    }
}