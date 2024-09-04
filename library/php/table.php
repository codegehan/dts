<?php
class Table {
    public static function Build($jsonData, $tableClass = null, $thClass = null, $trClass = null, $tdClass = null) {
        $data = json_decode($jsonData, true);
        if (!$data) {  throw new Exception("Invalid JSON data"); }
        $headers = array_keys(reset($data));
        $classAttribute = $tableClass ? 'class="' . implode(' ', (array)$tableClass) . '"' : '';
        $tableHtml = "<table $classAttribute><thead><tr>";
        foreach ($headers as $header) {
            $headerClassAttribute = $thClass ? 'class="' . implode(' ', (array)$thClass) . '"' : '';
            $tableHtml .= "<th $headerClassAttribute>$header</th>";
        }
        $tableHtml .= "</tr></thead>";
        $tableHtml .= "<tbody>";
        foreach ($data as $row) {
            $rowClassAttribute = $trClass ? 'class="' . implode(' ', (array)$trClass) . '"' : '';
            $tableHtml .= "<tr $rowClassAttribute>";
            foreach ($row as $cell) {
                $cellClassAttribute = $tdClass ? 'class="' . implode(' ', (array)$tdClass) . '"' : '';
                $tableHtml .= "<td $cellClassAttribute>$cell</td>";
            }
            $tableHtml .= "</tr>";
        }
        $tableHtml .= "</tbody></table>";
        return $tableHtml;
    }
}
?>