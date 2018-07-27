<?php

namespace AppBundle\Repository;

/**
 * OrderItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrderItemRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $arr
     * @return array
     * @throws \Exception
     */
    public function getTotCost($arr)
    {
        $totalQty = 0;
        $totalPrice = 0;
        $items = [];
        $itemObj = [];
        $result = [];
        foreach ($arr as $val) {
            if (isset($val['qty']) && is_numeric($val['qty'])) {
                $totalQty += $val['qty'];
            } else {
                throw new \Exception('Wrong data for quantity!');
            }

            $query = $this->createQueryBuilder('oi')
                ->select('SUM(oi.price) as price, oi.id as id, oi.name as name')
                ->where('oi.id = (:ids)')
                ->setParameter('ids', $val['id'])
                ->getQuery();

            $r = $query->getOneOrNullResult();
            if ($r) {
                $id = $r['id'];
                $name = $r['name'];
                $price = $r['price'];

                $totalPrice += $val['qty'] * $price;

                $itemObj['item']['id'] = $id;
                $itemObj['item']['name'] = $name;
                $itemObj['item']['price'] = $price;

                $itemObj['qty'] = $val['qty'];

                $itemObj['price'] = $val['qty'] * $price;

                $items[] = $itemObj;

            } else {
                throw $this->createNotFoundException(
                    'No item found for id ' . $val['id']
                );
            }
        }
        $result['tp'] = $totalPrice;
        $result['tq'] = $totalQty;
        $result['itm'] = $items;
        return $result;
    }
}
