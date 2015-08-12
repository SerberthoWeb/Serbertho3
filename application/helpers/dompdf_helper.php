<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('pdf_create')) {
    
    
	/**
	 * Generiert ein PDF mithilfe von DOMPDF
	 * 
	 * @access public
	 * @param string $html the HTML to render (default: '').
	 * @param string $filename optional file name to store the pdf (default: '').
	 * @param mixed $stream whether or not to stream to browser (default: false).
	 * @return mixed the raw PDF output if $stream is true, otherwise the PDF is
	 *         streamed to a file.
	 */
    
    
    function pdf_create($html = '', $filename = '', $stream = false) {
		require_once("dompdf/dompdf_config.inc.php");
		
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		if (!$stream) {
			$dompdf->stream($filename.".pdf");
		} else {
			return $dompdf->output();
		}
	}
}
?>
