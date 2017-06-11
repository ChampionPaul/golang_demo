package main

import (
	"demo1"
	"fmt"
)

func main() {
	//demo1.Testdemo()

	//线性表的初始化，插入，删除
	list := demo1.NewList()
	fmt.Println(list)
	res := list.Del(18)
	fmt.Println(list, res)
	res = list.Insert(17, 100)
	fmt.Println(list, res)
	res = list.Insert(12, 110)
	fmt.Println(list, res)
}
