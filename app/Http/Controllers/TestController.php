<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use phpDocumentor\Reflection\Types\Null_;
use App\Models\Duel;
class TestController extends Controller
{
    public function testGet()
    {
        return 'Hello test1';
    }
    
    
    public function testCreate()
    {
        Player::create([
            'surname'=> 'Васильев',
            'name'=> 'Василий',
        ]);

        return response()->json(true);
    }

    public function testDisplay()
    {
        return response()->json(Player::get()); //вернуть все в json
        //return Player::get(); // тоже самое
        //return Player::where('patronomyc','!=','NULL')->get(); // вернуть строки пустым отчеством
        //return Player::whereNotNull('patronomyc')->get(); //так лучше
        //return Player::find(1); // вернуть json строку с id=1
        //dd( Player::where('patronomyc','!=','NULL')->orWhere('id','>','2')->first()); //если 'равно' можно опустить второй аргумент
        //return Player::where('patronomyc','!=','NULL')->orWhere('id','>','2')->toSql(); //вернуть sql запрос
        //return Player::orderBy('name')->get(); // сортировка по sql вывод json
        //dd( Player::get()->sortBy('name')); // сортировка уже коллекции
    }


    public function testEdit()
    {
        /*
        $str = Player::find(8); //Редактирование1
        $str->surname = "Test1";
        $str->name = "Test1";
        $str->patronomyc = "Test1";
        $str->save();
        */

        /*
        Player::find(9)->update([ //Редактирование2
            'surname' => "Test2",
            'name' => "еest2",
            'patronomyc' => "Test2"
        ]);
        */

        /*
        Player::insert([ //Вставка строки(нет даты)
            'id' => 3,
            'surname' => "Test3",
            'name' => "Test3",
            'patronomyc' => "Test3"

        ]);
        */

        //Player::find(6)->delete(); //Удаление1

        /*
        $str1 = Player::find(7); //Удаление2
        $str1->delete();
        */

        return 'Hello test';
    }

    /*
    public function testPlayers($playerid) //вывод1
    {
        $player = Player::find($playerid);
        return response()->json(['data' => $player]);
    }
    */

    public function testPlayers(Player $player) //вывод2
    {
        return response()->json(['data' => $player]);
    }


    public function testPost(Request $request/*->name или ->only('name') или ->except('password') или ->input('test-test')*/) 
    {
        //return response()->json($request->input('name')); //вернуть значение указанного поля
        //return response()->json($request->has('name')); //проверка передачи данных(true даже пустые поля)
        //return response()->json($request->filled('name')); //проверка передачи данных(true только заполненные поля)
        //return response()->json($request->all()); //вернуть всё, что передали

        Player::create($request->all()); //из отправленного выбрать все и создать нового игрока
    
        return response()->json($request->all());
    }

    /*
    public function testUdate(Request $request, Player $player) 
    {
        $player->update($request->all()); //only('surname', 'name', 'patronomyc');

        return 123;//response()->json($request->only('surname', 'name', 'patronomyc'));
    }
    */

    public function testDuels(Player $player) // связь таблиц
    {
        //return Duel::where('id_first', $player->id)->orwhere('id_second', $player->id)->get(); // вывести матчи в которых участвовал игрок
    
        //return $player->showPlayerDuels;
        return $player->showPlayerDuels()->get();
    }


}
