## css3

### 一、css3D

#### css样式属性

#### animation

> animation: `animation-name`  `animation-duration`  `animation-timing-function`  `animation-delay`  `animation-iteration-count`   `animation-direction`  `animation-fill-mode`  `animation-play-state` 

所有属性的集合，遵循以下属性规则

> `animation-name`：指定 `@keyframes` 动画规则的名称

> `animation-duration` ：动画完成一个周期所需要的时间

> `animation-timing-function` 设置动画的进展如何通过每个周期的持续时间
>
> * `cubic-bezier(p1, p2, p3, p4)` 贝塞尔曲线
> * `steps(n, <jumpterm>)` n表示动画在一个周期跳几次，后者表示跳的动作end，start

> `animation-delay` ：配置动画延迟，默认0，若为负值，动画会立即执行，但会在负值绝对值处开始动画

> `animation-iteration-count` 动画周期应该停止前播放次数

> `animation-direction` ：动画的运动方向
>
> - `normal` 默认值，动画每个周期都会从正向开始位置（左-->右）播放
> - `reverse` 反着播放
> - `alternate` 正向循环播放（左右左....）
> - `alternate-reverse` 反向循环播放（右左右....）

> `animation-fill-mode` 应用动画规则里的样式
>
> * `none` 动画开始前和结束后不会应用动画样式（@keyframes）
> * `forwards` 应用动画最后一个关键帧的样式于动画结束后（@keyframes规则100%或0%定义的样式）
> * `backwards` 应用动画开始一个关键帧的样式于动画结束后（@keyframes规则100%或0%定义的样式）
> * `both` 动画将遵循向前和向后的规则，从而在两个方向上扩展动画属性。

> `animation-play-state` 允许您暂停和恢复动画序列
>
> * `paused` 暂停
> * `running` 正在播放

#### transition

> transition:  `transition-property`  `transition-duration`  `transition-timing-function`  `transition-delay`

#### transform

> 允许旋转(rotate)，缩放(scale)，倾斜(skew)或平移(translate)给定元素，属性都分为x, y轴
>
> ```javascript
> translate3d(x, y, z)   3d平移
> rotate3d(x, y, z)    3D旋转
> perspective(x) 透视距离
> ```
>
> transform：perspective 和 perspective的区别
>
> > perspective用在父元素上，transform：perspective用在自身，效果一样

