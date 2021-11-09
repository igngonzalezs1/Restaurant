<?php
use Migrations\AbstractSeed;

/**
 * Books seed.
 */
class BooksSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 6, 'name' => 'El libro negro', 'sypnosis' => 'Angel David Revilla', 'book_dir' => 'uploads\books\6\el-libro-negro-dross-D_NQ_NP_976686-MLA31584995016_072019-F.jpg', 'cost' => 6000, 'dcto_percent' => null, 'stock' => 10],
            ['id' => 7, 'name' => 'La larga mancha', 'sypnosis' => 'Stephen King ', 'book_dir' => 'uploads\books\7\D_NQ_NP_630109-MLC26723606284_012018-V.jpg', 'cost' => 8000, 'dcto_percent' => null, 'stock' => 4],
            ['id' => 8, 'name' => 'Dracula', 'sypnosis' => 'Bram Stoker ', 'book_dir' => 'uploads\books\8\w200_u90.jpg', 'cost' => 12000, 'dcto_percent' => null, 'stock' => 12],
            ['id' => 9, 'name' => 'El mago de oz', 'sypnosis' => 'Lyman Frank Baum ', 'book_dir' => 'uploads\books\9\978607143018.jfif', 'cost' => 25000, 'dcto_percent' => null, 'stock' => 3],
            ['id' => 10, 'name' => 'Papelucho: Casi huerfano', 'sypnosis' => 'Marcela Paz ', 'book_dir' => 'uploads\books\10\D_NQ_NP_698381-MLC28853323382_122018-V.jpg', 'cost' => 7000, 'dcto_percent' => null, 'stock' => 11],
            ['id' => 11, 'name' => 'Cementerio de animales', 'sypnosis' => 'Stephen King ', 'book_dir' => 'uploads\books\11\D_NQ_NP_813404-MLC25867294208_082017-V.jpg', 'cost' => 30000, 'dcto_percent' => null, 'stock' => 9],
            ['id' => 12, 'name' => 'Las aventuras de Sherlock Holmes', 'sypnosis' => 'Arthur Conan Doyle ', 'book_dir' => 'uploads\books\12\libro-las-aventuras-de-sherlock-holmes-arthur-conan-doyle-D_NQ_NP_934100-MLU31656446233_082019-F.jpg', 'cost' => 7000, 'dcto_percent' => null, 'stock' => 15],
            ['id' => 13, 'name' => 'El gato negro y otros cuentos', 'sypnosis' => 'Edgar Allan Poe ', 'book_dir' => 'uploads\books\13\el-gato-negro-y-otros-cuentos-edgar-allan-poe-D_NQ_NP_689856-MLA26540303719_122017-F.jpg', 'cost' => 8000, 'dcto_percent' => null, 'stock' => 14],
            ['id' => 14, 'name' => 'Frankenstein', 'sypnosis' => 'Mary Shelley ', 'book_dir' => 'uploads\books\14\D_NQ_NP_947720-MLU27778839657_072018-W.jpg', 'cost' => 9000, 'dcto_percent' => null, 'stock' => 8],
            ['id' => 15, 'name' => 'La torre oscura I', 'sypnosis' => 'Stephen King ', 'book_dir' => 'uploads\books\15\D_NQ_NP_803666-MLC29440231920_022019-V.jpg', 'cost' => 7500, 'dcto_percent' => null, 'stock' => 10],
            ['id' => 16, 'name' => 'Metamorfosis', 'sypnosis' => 'Franz Kafka ', 'book_dir' => 'uploads\books\16\la-metamorfosis-la-condena-el-fogonero-franz-kafka-libro-D_NQ_NP_973089-MLA31787241430_082019-Q.jpg', 'cost' => 2500, 'dcto_percent' => null, 'stock' => 9],
            ['id' => 17, 'name' => 'El principito', 'sypnosis' => 'Antoine de Saint-Exupéry ', 'book_dir' => 'uploads\books\17\D_NQ_NP_667253-MLU26328031866_112017-W.jpg', 'cost' => 9990, 'dcto_percent' => null, 'stock' => 5]
        ];

        $table = $this->table('books');
        $table->insert($data)->save();
    }
}
