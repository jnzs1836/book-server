<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BookTableSeeder extends Seeder{
    /**
     * 运行数据库填充
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        $names = [
            '他改变了中国', '他改变了美国',  '他改变了英国',  '他改变了德国', '他改变了日本'
        ];
        $authors = [
            '劳伦斯','江泽民', 'JK R', 'Martin', 'John'
        ];
        $presses = [
            '人民文学出版社', 'springer'
        ];

        $books = [
            [
                'name' => '旅行与读书（2016台北书展年度之书）',
                'author' => '詹宏志',
                'press' => '中信出版集团',
                'sell_price' => '34.09',
                'origin_price' => 21.99,
                'category' => '旅行',
                'pic' => 'book1.jpg',
                'owner_id' => 3,
                'link' => 'https://www.amazon.cn/dp/B01JFIE3KA/ref=sr_1_5?__mk_zh_CN=%E4%BA%9A%E9%A9%AC%E9%80%8A%E7%BD%91%E7%AB%99&keywords=%E6%97%85%E8%A1%8C&qid=1561985296&s=gateway&sr=8-5',
                'introduction'=> "《旅行与读书》2016台北国际书展年度之书,在书上，在路上，旅行就是一段勇敢前进的人生。"
            ],
            [
                'name' => '旅行的艺术（中英双语插图本） (阿兰·德波顿作品双语版)',
                'author' => '阿兰·德波顿(Alain de Botton)',
                'press' => '上海译文出版社',
                'sell_price' => 14.99,
                'origin_price' => 11.99,
                'category' => '旅行',
                'pic' => 'book2.jpg',
                'owner_id' => 2,
                'link' => 'https://www.amazon.cn/dp/B00OZBF2FS/ref=sr_1_6?__mk_zh_CN=%E4%BA%9A%E9%A9%AC%E9%80%8A%E7%BD%91%E7%AB%99&keywords=%E6%97%85%E8%A1%8C&qid=1561985296&s=gateway&sr=8-6',
                'introduction'=> "《旅行的艺术》是被誉为“英国文坛奇葩”的才子型作家阿兰·德波顿的重要作品，自2002年出版以来，长踞英美畅销书排行榜。"
            ],
            [
                'name' => '旅行摄影圣经(完美随行版)',
                'author' => '张千里',
                'press' => '人民邮电出版社',
                'sell_price' => 9.99,
                'origin_price' => 3.76,
                'category' => '旅行',
                'pic' => 'book3.jpg',
                'owner_id' => 3,
                'link' => 'https://www.amazon.cn/dp/B00TGW040Y/ref=sr_1_10?__mk_zh_CN=%E4%BA%9A%E9%A9%AC%E9%80%8A%E7%BD%91%E7%AB%99&keywords=%E6%97%85%E8%A1%8C&qid=1561985296&s=gateway&sr=8-10',
                'introduction'=> ""
            ],
            [
                'name' => '他改变了中国',
                'author' => '罗伯特·劳伦斯',
                'press' => '上海译文出版社',
                'sell_price' => 40.06,
                'origin_price' => 33.03,
                'category' => '人物',
                'pic' => 'book4.jpg',
                'owner_id' => 3,
                'link' => 'https://www.amazon.cn/dp/B072HT5C99/ref=sr_1_1?__mk_zh_CN=%E4%BA%9A%E9%A9%AC%E9%80%8A%E7%BD%91%E7%AB%99&keywords=%E4%BB%96%E6%94%B9%E5%8F%98%E4%BA%86&qid=1561985680&s=gateway&sr=8-1',
                'introduction'=> "《他改变了中国：江泽民传》这本传记介绍了江泽民同志的人生历程，尤其是阐述和评价了江泽民同志担任中国主要领导人的10多年中创立的历史功绩。"
            ],
            [
                'name' => '稻盛和夫自传',
                'author' => '稻盛和夫',
                'press' => '东方出版社',
                'sell_price' => 27.05,
                'origin_price' => 20.00,
                'category' => '人物',
                'pic' => 'book5.jpg',
                'owner_id' => 4,
                'link' => 'https://www.amazon.cn/dp/B00XVNXNNE/ref=sr_1_4?__mk_zh_CN=%E4%BA%9A%E9%A9%AC%E9%80%8A%E7%BD%91%E7%AB%99&keywords=%E8%87%AA%E4%BC%A0&qid=1561985546&s=gateway&sr=8-4',
                'introduction'=> "他与昔日同事朋友创立世界500强京瓷，他向垄断的巨型企业挑战、建立第二电电，他重建濒临破产的日航。他就是励志传记中的热血经营者稻盛和夫。"
            ],
            [
                'name' => '成为：米歇尔·奥巴马自传',
                'author' => '米歇尔·奥巴马',
                'press' => '天地出版社',
                'sell_price' => 49,
                'origin_price' => 35,
                'category' => '人物',
                'pic' => 'book6.jpg',
                'owner_id' => 2,
                'link' => 'https://www.amazon.cn/dp/B07MGH4F4T/ref=sr_1_5?__mk_zh_CN=%E4%BA%9A%E9%A9%AC%E9%80%8A%E7%BD%91%E7%AB%99&keywords=%E8%87%AA%E4%BC%A0&qid=1561985546&s=gateway&sr=8-5',
                'introduction'=> "美国前第一夫人亲笔自传，内涵丰富，鼓舞人心。  海外一经上市即成为年度最轰动的畅销书之一"
            ],
            [
                'name' => '深入理解计算机系统',
                'author' => '龚奕利',
                'press' => '机械工业出版社',
                'sell_price' => 105,
                'origin_price' => 73,
                'category' => '计算机',
                'pic' => 'book7.jpg',
                'owner_id' => 5,
                'link' => 'https://www.amazon.cn/dp/B07MGH4F4T/ref=sr_1_5?__mk_zh_CN=%E4%BA%9A%E9%A9%AC%E9%80%8A%E7%BD%91%E7%AB%99&keywords=%E8%87%AA%E4%BC%A0&qid=1561985546&s=gateway&sr=8-5',
                'introduction'=> "基于x86-64，大量地重写代码，首次介绍对处理浮点数据的程序的机器级支持。"
            ],
            ];
        foreach($books as $book) {
            DB::table('books')->insert([
                'name' => $book['name'],
                'author' => $book['author'],
                'press' => $book['press'],
                'sell_price' => $book['origin_price'],
                'origin_price' => $book['sell_price'],
                'category' => $book['category'],
                'pic'=> $book['pic'],
                'owner_id'=> $book['owner_id'],
                'introduction' => $book['introduction'],
                'link' => $book['link']
            ]);
            $i = $i + 1;
        }
    }
}