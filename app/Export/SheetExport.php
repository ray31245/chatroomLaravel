<?php
namespace App\Export;

use Config;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;  //調整寬度
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
//方法一
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
//方法二
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use BaseFunction;
use App\Export\SearchFunction;

//方法二
class SheetExport extends SearchFunction implements FromView, WithTitle, ShouldAutoSize, WithCustomValueBinder
{
    use Exportable;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

   public function view(): View
    {
        //這邊內容自己寫
        // $data = Config::get('models.Lost')::select('number','date','title','type','location','content','note','created_at','updated_at');
        // if(!empty($this->get_data['search'])){
        //     $search = json_decode($this->get_data['search'], true);
        //     $query = SearchFunction::search($search);
        //     $data = $data->where('branch_id', $this->branch['id'])->where($query)->get()->toArray();
        // }else{
        //     $data = $data->where('branch_id', $this->branch['id'])->get();
        // }
        //顯示圖片
        //dd($this->data);
        //$tt = view('excel', [
        //    'data' => $this->data
        //])->render();
        //dd($tt);
        return view('excel', [
            'data' => $this->data
        ]);
    }
    public function bindValue(Cell $cell, $value)
    {
        //if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        //}
        // else return default behavior
        //return parent::bindValue($cell, $value);
    }
    public function title(): string
    {
        return $this->data['title'];
    }
}

/*//方法一
class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Config::get('models.Lost')::select('number','date','title','type','location','content','note','created_at','updated_at')->get();
    }
    public function headings(): array
    {
        return [
            '登錄單號',
            '拾獲日期',
            '品項 / 數量',
            '狀態',
            '拾獲樓層',
            '拾獲地點',
            '備註',
            '資料建立日期',
            '最後修改日期'
        ];
    }
}*/

