# Genetic Algorithm Optimiser

[Genetic Alorithms](https://en.wikipedia.org/wiki/Genetic_algorithm) are a class of machine learning approaches that use the principles of natural selection, rather than the solving of mathematical formulae to find solutions to optimisation and search type problems. They are especially effective in complex situation that aren't easily "solved" and can often be used as a more-easily understood alternative to neural networks.

This framework takes care of most of the steps (loops) needed when developing and running a genetic algorithm, leaving you needing only to define the shape of your expected solution and a function to evaluate each solution faciliating the comparison of candidate solutions and thus the march towards an optimum. 

## Installation

You can install the package via composer:

```bash
composer require petercoles/gao
```

## Usage

Firstly create a class that defines a generic solution to the problem to be solved. The class must extend this package's Solution class, which will force the implemetation of two methods: genome() which defines the shape of a valid solution and evaluate(), which will calculate a numerical value that can be used to compare solutions.

``` php
use PeterColes\GAO\Solution;

class MySolution extends Solution
{
    public function genome()
    {
        return [
            ['char', 'ABC'],
            ['float', 0, 1],
            ['integer', -100, 100],
        ];
    }

    public function evaluate($data = null)
    {
        $this->fitness = (ord($this->chromosomes[0]) + $this->chromosomes[2]) / $this->chromosomes[1];
    }
}
```

Then instantiate and run the optimiser, creating an initial population of possible solutions to start its evaluation.

```
$optimiser = new Optimiser(new Population(MySolution::class, 100));
$optimiser->run();
foreach ($optimiser->results as $solution) {
    print_r($solution->summary());
}
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email peterdcoles@gmail.com instead of using the issue tracker. I take security very seriously and will welcome and respond promptly to your input.

## Credits

- [Peter Coles](https://github.com/petercoles)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
